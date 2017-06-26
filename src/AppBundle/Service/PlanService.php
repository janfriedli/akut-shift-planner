<?php

namespace AppBundle\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Provides Plans based upon the logged in user
 * Class PlanService
 */
class PlanService {

    /**
     * @var $tokenStorage
     * type TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $em, UserService $userService)
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $em;
        $this->userService = $userService;

    }

    /**
     * Select correct plans to display
     * by user
     *
     * @return ArrayCollection
     */
    public function getPlans()
    {
        $queryBuilder = $this->em->getRepository('AppBundle:Plan')->createQueryBuilder('p');

        $qb = $queryBuilder->where('p.isTemplate = true');

        if (!$this->userService->getUser()) {
            $qb->andWhere('p.isPublic = true');
        } else {
            $qb->andWhere('p.user = :user')->setParameter('user', $this->userService->getUser()->getId());
            $qb->orWhere('p.isPublic = true');
        }

        return $qb->orderBy('p.title', 'ASC')->getQuery()->getResult();
    }

}

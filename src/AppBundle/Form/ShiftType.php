<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;


class ShiftType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $classes = 'form-control';

        $builder
            ->add('title', null, array(
                'attr'  => array('class' => $classes)
            ))
            ->add('description', null, array(
                'attr'  => array('class' => $classes)
            ))
            ->add('start', TimeType::class, array(
                'attr'  => array('class' => $classes),
                'widget' => 'single_text'
            ))
            ->add('end', TimeType::class, array(
                'attr'  => array('class' => $classes),
                'widget' => 'single_text'
            ))
            ->add('numberPeople', null, array(
                'attr'  => array('class' => $classes)
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Shift'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_shift';
    }


}

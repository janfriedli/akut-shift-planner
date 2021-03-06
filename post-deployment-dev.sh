#!/usr/bin/env bash
wget https://getcomposer.org/download/1.4.2/composer.phar
SYMFONY_ENV=prod php71 composer.phar install --no-dev --optimize-autoloader
php71 bin/symfony_requirements
php71 bin/console cache:clear --env=prod --no-debug --no-warmup
php71 bin/console cache:warmup --env=prod
php71 bin/console assetic:dump --env=prod --no-debug --env=prod
php71 bin/console doctrine:schema:update --force --env=prod

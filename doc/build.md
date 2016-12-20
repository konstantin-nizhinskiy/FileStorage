git pull

php bin/console doctrine:schema:update --env=prod --force
php bin/console cache:clear --env=dev --no-debug
php bin/console cache:clear --env=prod --no-debug
php bin/console assetic:dump --env=prod --no-debug
find var -type f -exec chmod 777 {} +
find var -type d -exec chmod 777 {} +
#!/bin/sh

EXPECTED_SIGNATURE="$(wget -q -O - https://composer.github.io/installer.sig)"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_SIGNATURE="$(php -r "echo hash_file('sha384', 'composer-setup.php');")"

if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]
then
    >&2 echo 'ERROR: Invalid installer signature'
    rm composer-setup.php
    exit 1
fi

php composer-setup.php --quiet
RESULT=$?
rm composer-setup.php
sudo mv composer.phar composer
sudo chmod +x composer
exit $RESULT

sudo adduser root www-data
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
sudo find ./ -type f -exec chmod 664 {} \;
sudo find ./ -type d -exec chmod 775 {} \;
sudo rm -rf bootstrap/cache/*.php && sudo  composer dump-autoload && sudo  php artisan config:cache && sudo  php artisan view:clear && sudo  php artisan route:clear
sudo php artisan config:cache
git config core.fileMode false

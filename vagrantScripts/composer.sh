#! /bin/sh

# Get Composer Files.
cd /var/www/html
curl -Ss https://getcomposer.org/installer | php
sudo mv composer.phar /usr/bin/composer
cd /var/www/html/LindyHopperTaipei
composer install --no-plugins --no-scripts --no-dev --optimize-autoloader

sudo service apache2 restart
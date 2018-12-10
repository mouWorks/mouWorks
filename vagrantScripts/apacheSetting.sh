#! /bin/sh
# Setup Apache Settings Here
# 1. Replace Apache2.conf with our setup
# 2. Use mouwork.conf to setup
# 3. Use index.php to redirect

#Move the redirect
sudo cp /var/www/html/LindyHopperTaipei/config/index.php /var/www/html
sudo rm /var/www/html/index.html

sudo rm /etc/apache2/apache2.conf
sudo cp /var/www/html/LindyHopperTaipei/config/apache2.conf /etc/apache2/
sudo cp /var/www/html/LindyHopperTaipei/config/LindyHopperTaipei.conf /etc/apache2/sites-available

sudo a2ensite LindyHopperTaipei.conf
sudo a2dissite 000-default.conf
sudo a2enmod rewrite
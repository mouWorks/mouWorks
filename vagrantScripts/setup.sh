#! /bin/sh

# Install
# Note this has upgraded to PHP 7.2 related.
sudo apt-get update && sudo apt-get upgrade
add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get -y install apache2 php7.2 libapache2-mod-php7.2 sysv-rc-conf php7.2-xml php-mbstring php7.2-curl php-apcu
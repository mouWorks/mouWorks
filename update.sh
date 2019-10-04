#! /bin/sh
#echo ">>> Remove Previous folder if exist"
#if [ -d /var/www/html ]; then
#    rm -rf /var/www/html
#fi
#
#echo "Create Folder"
#sudo mkdir /var/www/html
#
#echo ">>> Unzipping files inside Droplet"
#tar -xf code.tar.gz
#sudo mv www html
#sudo mv html /var/www

echo ">>> Remove Previous folder if exist"
if [ -d /usr/share/nginx/html ]; then
    rm -rf /usr/share/nginx/html
fi

echo "Create Folder"
sudo mkdir /usr/share/nginx/html

echo ">>> Unzipping files inside Droplet"
tar -xf code.tar.gz
sudo mv www html
sudo mv html /usr/share/nginx

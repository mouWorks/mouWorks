#! /bin/sh
echo ">>> Remove Previous folder if exist"
if [ -d /var/www/html ]; then
    rm -rf /var/www/html
fi

echo "Create Folder"
sudo mkdir /var/www/html

echo ">>> Unzipping files inside Droplet"
tar -xvf code.tar.gz
sudo mv www html
sudo mv html /var/www


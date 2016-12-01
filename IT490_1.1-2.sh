#!/bin/bash


unalias cp
tar -xvf IT490_1.1-2.tar.gz
cd temp/
sudo yes | cp -rTf demo/. /var/www/demo
#cd demo/
#sudo chmod 777 css
#sudo cp -rTf css/. /var/www/demo/css
#exec sudo cd /temp/
sudo cp -rf apache2	/etc
sudo cp -rf mysql	/etc
sudo cp -rf phpmyadmin	/etc
sudo cp -rTf php/.	/etc
sudo cp -rf rabbitmq	/etc
cd ..
sudo rm -r temp/

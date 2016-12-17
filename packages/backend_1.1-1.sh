#!/bin/bash

unalias cp
tar -xvf backend_1.1-1.tar.gz
sudo yes | cp -rTF demo/. /var/www/demo

cd ..
sudo rm -r temp

#!/bin/bash

cd /lib
mkdir client
cd client
git clone "https://bitbucket.org/quind/quind-client" .

composer install

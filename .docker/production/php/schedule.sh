#!/bin/bash

while [ true ]; do
    /usr/local/bin/php /var/www/artisan schedule:run --verbose --no-interaction &
    sleep 60
done

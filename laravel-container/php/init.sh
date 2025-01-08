#!/bin/bash

# Laravel initialization commands
php artisan config:clear
php artisan key:generate
php artisan migrate
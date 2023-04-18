#!/bin/bash

mv .env.example .env

if [ $? -eq 0 ]; then
  echo -e "\e[32m\xE2\x9C\x85 .env file created\e[0m"
else
  echo -e "\e[31m\xE2\x9D\x8C .env file not created\e[0m"
fi

composer install

if [ $? -eq 0 ]; then
  echo -e "\e[32m\xE2\x9C\x85 done\e[0m"
else
  echo -e "\e[31m\xE2\x9D\x8C not done\e[0m"
fi

php artisan key:generate

if [ $? -eq 0 ]; then
  echo -e "\e[32m\xE2\x9C\x85 Application key generated\e[0m"
else
  echo -e "\e[31m\xE2\x9D\x8C Apllication key not generated\e[0m"
fi

php artisan serve

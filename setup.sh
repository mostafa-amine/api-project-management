#!/bin/bash

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

php artisan migrate:fresh --seed

if [ $? -eq 0 ]; then
  echo -e "\e[32m\xE2\x9C\x85 Database Created\e[0m"
else
  echo -e "\e[31m\xE2\x9D\x8C Database Failed\e[0m"
fi

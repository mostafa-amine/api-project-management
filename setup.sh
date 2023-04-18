#!/bin/bash

BRANCH_NAME="feature"

git branch $BRANCH_NAME
git switch $BRANCH_NAME

if [ $? -eq 0 ]; then
echo -e "\e[32m\xE2\x9C\x85 $BRANCH_NAME created and switched\e[0m"
else
echo -e "\e[31m\xE2\x9D\x8C $BRANCH_NAME creation and switch failed\e[0m"
fi

mv .env.example .env

if [ $? -eq 0 ]; then
echo -e "\e[32m\xE2\x9C\x85 .env.example file moved to .env successfully\e[0m"
else
echo -e "\e[31m\xE2\x9D\x8C .env.example file move to .env failed\e[0m"
fi

composer install

if [ $? -eq 0 ]; then
echo -e "\e[32m\xE2\x9C\x85 Composer install succeeded\e[0m"
else
echo -e "\e[31m\xE2\x9D\x8C Composer install failed\e[0m"
fi

php artisan key:generate

if [ $? -eq 0 ]; then
echo -e "\e[32m\xE2\x9C\x85 Application key generated successfully\e[0m"
else
echo -e "\e[31m\xE2\x9D\x8C Application key generation failed\e[0m"
fi

php artisan serve

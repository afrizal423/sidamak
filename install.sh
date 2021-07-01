#!/bin/bash

NOCOLOR='\033[0m'
RED='\033[0;31m'
GREEN='\033[0;32m'
ORANGE='\033[0;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
LIGHTGRAY='\033[0;37m'
DARKGRAY='\033[1;30m'
LIGHTRED='\033[1;31m'
LIGHTGREEN='\033[1;32m'
YELLOW='\033[1;33m'
LIGHTBLUE='\033[1;34m'
LIGHTPURPLE='\033[1;35m'
LIGHTCYAN='\033[1;36m'
WHITE='\033[1;37m'

echo -e "\n${LIGHTGREEN}Proses composer install dan npm install serta build\n${NOCOLOR}"
composer install
npm install
npm run dev
echo -e "\n${YELLOW}Apakah anda ingin mengopy file env.example menjadi env ?${NOCOLOR}"
read VAR

if [[ $VAR = 'y' ]] || [[ $VAR = 'ya' ]] || [[ $VAR = 'yes' ]]
then
    echo -e "${LIGHTGREEN}copying file .env.example to .env\n${NOCOLOR}"
    cp .env.example .env
#   echo "The variable is greater than 10."
fi
php artisan key:generate
php artisan migrate
echo -e "\n${LIGHTGREEN}Proses publish jetstream dan livewire\n${NOCOLOR}"
php artisan vendor:publish --tag=jetstream-views
php artisan livewire:publish --assets
php artisan livewire:publish
echo -e "\n${YELLOW}Silahkan pilih publish package yang dibutuhkan (calendar, chart)\n${NOCOLOR}"
php artisan vendor:publish
echo -e "\n${WHITE}Setelah itu jangan lupa${NOCOLOR}"
echo -e "\n${LIGHTRED}Buka file config/liveware.php lalu edit bagian asset_url${NOCOLOR}"
echo -e "\n${WHITE}dan ...${NOCOLOR}"
echo -e "\n${LIGHTRED}Buka file resources/views/layouts/app.blade.php Ubah mix jadi asset${NOCOLOR}"

# practice_hustory_auto
Задание на практику Ратников К. Проверка истории авто

Информация по работе программы

На сайте gibdd_find.php пользователь вводит vin номер авто, переходит на capcha.php, где скрипт python загружает капчу с сайта гибдд, пользователь ее разгадывает, далее токены и ответы капчи передаются на gibdd_search.php, где происходит подключение к БД, запуск скрипта на php
при помощи функции exec('python3 /var/www/site1/main.py  '. $vin, $exec_res);

'python3 /var/www/site1/main.py  '. $vin означет, что необходимо запустить скрипт python по пути  /var/www/site1/main.py и передать значение переменной $vin

Метод requests.post(url, data ).json() вернет необходимые данные, например

history = requests.post('https://xn--b1afk4ade.xn--90adear.xn--p1ai/proxy/check/auto/history', data={<данные в виде POST>}).json()

первым параметром передается ссылка, которыя обрабатывает запрос на получение данных, далее передаются данные POST, по которым сайт возвращает данные.
После чего скрипт удаляет старые данные из БД и записывает новые

После того, как отработает скрипт gibdd_search.php читает данные из БД и генерирует блоки с необходимой информацией. Функции генерации находятся в system/functions.php

OS сервера ubuntu-20.04.4-live-server

Установка через Docker,также работает на windows

Если Docker установлен, то

Запуск контейнера

cd "путь к файлу"/docker_project 

sudo docker-compose up

Инструкция на чистый сервер ubuntu-20.04.4

Установка Docker

sudo apt update

sudo dpkg --configure -a

sudo apt install apt-transport-https ca-certificates curl software-properties-common

curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu focal stable"

sudo apt update

apt-cache policy docker-ce

sudo apt install docker-ce

apt-cache policy docker-ce


Установка Docker Compose

sudo curl -L "https://github.com/docker/compose/releases/download/1.26.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

sudo chmod +x /usr/local/bin/docker-compose

docker-compose --version

Запуск контейнера

cd "путь к файлу"/docker_project 

sudo docker-compose up

Добавление домена

В файле "C:\Windows\System32\drivers\etc\hosts" добавить 

"ip сервера" localhost

Открыть в браузере localhost/



Также можно установить без Docker, вручную настроив сервер, у меня работало на apache, php, myqsl, python

apache 2.4.41 ubuntu

php 7.4.3

myqsl 8.0.28

python 3.8.10

Далее создать домен и загрузить на него файлы из папки project



Можно вводить любые vin номера, но для простоты привожу пример

X9FFXXEEDF4K30119

WDD2130431A224736

Z8TXTGF2WHM045743

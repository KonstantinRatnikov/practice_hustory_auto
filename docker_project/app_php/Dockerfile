FROM php:7.4-apache
RUN apt-get update
RUN apt-get install -y python3
RUN apt-get install -y python3-pip
RUN pip3 install requests
RUN pip3 install cryptography
RUN pip3 install pymysql
#RUN apt install -y php-mysqli
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
COPY src/ /var/www/html/



#FROM python:3.8.10
#RUN pip install pymysql
#RUN pip install requests
#RUN pip install cryptography
#WORKDIR /app
#COPY main.py /app/main.py
#CMD tail -f /dev/null
#RUN apt install php
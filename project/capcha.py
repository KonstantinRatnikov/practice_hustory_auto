import requests
# print обязателен, значения передаются в php
for i in range(5):
    capcha = requests.get('https://check.gibdd.ru/captcha').json()
    print(capcha['token'])
    print(capcha['base64jpg'])

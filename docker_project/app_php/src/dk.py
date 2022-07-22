import requests
import pymysql
from sys import argv
import os
vin = argv[1]

token1 = argv[2]
code1 = argv[3]

db = pymysql.connect(host=os.getenv('MSQ_HOST'), user='root', passwd='kostya.1100', db='practice', charset='utf8')

def reqSQL(dataBase, req):
 with dataBase.cursor() as cursor:
  cursor.execute(req)
  dataBase.commit()

#диагностика
data_diagnostic={'vin': vin,
      'checkType': 'diagnostic',
      'captchaWord': code1,
      'captchaToken': token1
      }
try:
 diagnostic = requests.post('https://xn--b1afk4ade.xn--90adear.xn--p1ai/proxy/check/auto/diagnostic', data=data_diagnostic).json()['RequestResult']['diagnosticCards']
except:
 print("ex")
print(diagnostic)
try:
 diagnostic = diagnostic[0]
 diagnostic['chassis'] += "-"
 del_query = 'Delete from gibdd_dk where vin = "' + vin + '"'
 insert_movies_query = 'INSERT INTO gibdd_dk (dcNumber, dcDate, dcExpirationDate, pointAddress, vin, body , chassis, brand , model, odometerValue) VALUES ("' + diagnostic['dcNumber'] + '","' + diagnostic['dcDate'] + '","' + diagnostic['dcExpirationDate'] + '","' + diagnostic['pointAddress'] + '","' + vin + '","' + diagnostic['body'] + '","' + diagnostic['chassis'] + '","' + diagnostic['brand'] + '","' + diagnostic['model'] + '","' + diagnostic['odometerValue'] + '");'
 reqSQL(db, del_query)
 reqSQL(db, insert_movies_query)
except:
 print("ex")
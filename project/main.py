import requests
import pymysql
from sys import argv

vin = argv[1]

token1 = argv[2]
code1 = argv[3]

token2 = argv[4]
code2 = argv[5]

token3 = argv[6]
code3 = argv[7]

token4 = argv[8]
code4 = argv[9]

db = pymysql.connect(host='localhost', user='root', passwd='kostya.1100', db='practice', charset='utf8')

def reqSQL(dataBase, req):
 with dataBase.cursor() as cursor:
  cursor.execute(req)
  dataBase.commit()

#история
data_history={'vin': vin,
      'checkType': 'history',
      'captchaWord': code1,
      'captchaToken': token1
      }
history = requests.post('https://xn--b1afk4ade.xn--90adear.xn--p1ai/proxy/check/auto/history', data=data_history).json()
print(history)
try:
 ownershipPeriods = history['RequestResult']['ownershipPeriods']['ownershipPeriod']
 period =""
 for el in ownershipPeriods:
  if el['simplePersonType']=='Natural':
   owner='физическое лицо'
  else:
   owner = 'юридическое лицо'
  period += "С " + el['from'] + " по: " + el.get("bogus", "настоящее время") + " : " + owner + "\n"
 history = history['RequestResult']['vehicle']
except Exception as ex:
 print(ex)
del_query = 'Delete from gibdd where vin = "'+vin+'"'
print(del_query)
insert_movies_query = 'INSERT INTO gibdd (model,release_year,vin, frame_number, cabin_number, cabin_color, engine_number, displacement, power, vehicle_type, holding_period) VALUES ("'+history['model']+'","'+history['year']+'","'+vin+'","'+"-"+'","'+history['bodyNumber']+'","'+history['color']+'","'+history['engineNumber']+'","'+history['engineVolume']+'","'+history['powerKwt']+"/"+history['powerHp']+'","'+history['category']+'","'+period+'");'
print(insert_movies_query)
reqSQL(db, del_query)
reqSQL(db, insert_movies_query)

#розыск
try:
 data_wanted={'vin': vin,
      'checkType': 'wanted',
      'captchaWord': code2,
      'captchaToken': token2
      }
 wanted = requests.post('https://xn--b1afk4ade.xn--90adear.xn--p1ai/proxy/check/auto/wanted', data=data_wanted).json()['RequestResult']['records']

 print(ex)
 #print(wanted)
 del_query = 'Delete from gibdd_wanted where w_vin = "'+vin+'"'
 reqSQL(db, del_query)

 for w in wanted:
  insert_movies_query = 'INSERT INTO gibdd_wanted (w_vin, w_model, w_god_vyp, w_data_pu, w_reg_inic) VALUES ("'+vin+'","'+w['w_model']+'","'+w['w_god_vyp']+'","'+w['w_data_pu']+'","'+w['w_reg_inic']+'");'
  reqSQL(db, insert_movies_query)
except Exception as ex:
 print(ex)
#ограничения
data_wanted={'vin': vin,
      'checkType': 'restricted',
      'captchaWord': code3,
      'captchaToken': token3
      }
try:
 restrict = requests.post('https://xn--b1afk4ade.xn--90adear.xn--p1ai/proxy/check/auto/restrict', data=data_wanted).json()['RequestResult']['records']
except:
 print("ex")
#print(restrict)
try:
 restrict =restrict[0]
 del_query = 'Delete from gibdd_restrict where tsVIN = "'+vin+'"'
 insert_movies_query = 'INSERT INTO gibdd_restrict (tsVIN, tsmodel, tsyear, dateogr, regname, codeTo, divtype, osnOgr, phone, gid) VALUES ("'+vin+'","'+restrict['tsmodel']+'","'+str(restrict['tsyear'])+'","'+restrict['dateogr']+'","'+restrict['regname']+'","'+str(restrict['codeTo'])+'","'+str(restrict['divtype'])+'","'+restrict['osnOgr']+'","'+restrict['phone']+'","'+restrict['gid']+'");'
 reqSQL(db, del_query)
 reqSQL(db, insert_movies_query)
except Exception as ex:
 print(ex)

#дтп
data_dtp={'vin': vin,
      'checkType': 'aiusdtp',
      'captchaWord': code4,
      'captchaToken': token4
      }
dtp_arr = requests.post('https://xn--b1afk4ade.xn--90adear.xn--p1ai/proxy/check/auto/dtp', data=data_dtp).json()
print("дтп")
print(dtp_arr)
del_query = 'Delete from gibdd_dtp where vin = "' + vin + '"'
reqSQL(db, del_query)

for el in dtp_arr['RequestResult']['Accidents']:
 picture = ""
 for p in el['DamagePoints']:
  picture+='V'+p+" "
 q = 'INSERT INTO gibdd_dtp (number, vin, date, type, region, place, model, release_year, opf_owner, num_all,picture) values ("' + str(el['AccidentNumber']) + '","' + vin + '","' + str(el['AccidentDateTime']) + '","' + str(el['AccidentType']) + '","' + str(el['RegionName']) + '","' + str(el['AccidentPlace']) + '","' + str(el['VehicleMark']) + '","' + str(el['VehicleYear']) + '","' + str(el['OwnerOkopf']) + '","' + str(el['VehicleSort']) +"/"+str(el['VehicleAmount'])+ '","' + picture + '")'
 reqSQL(db, q)

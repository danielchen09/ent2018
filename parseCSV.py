import csv
import re
import pymysql.cursors

connection = pymysql.connect(host = "localhost",
                             user = "root",
                             password = "101dc101",
                             db = "hospitalApp")

count = 0;

with open("TaiwanHospitalInformation.csv", encoding = "utf-8") as file:
    reader = csv.reader(file, delimiter = ",")
    names = []
    addr = []
    phone = []
    type = []
    for row in reader:
        names.append(row[1])
        addr.append(row[6])
        type.append(row[3])
        if count == 0:
            count += 1
            phoneNum = row[5]

        else:
            phoneNum = re.sub("[^0-9]", "", row[5])
            if len(phoneNum) == 0:
                phoneNum = "N/A"
            else:
                if phoneNum[0] != "0":
                    phoneNum = "0" + phoneNum
        phone.append(phoneNum)

    names.remove("機構名稱")
    addr.remove("地址")
    phone.remove("電話")
    type.remove("型態別")
    for x, y, z, a in zip(names, addr, phone, type):

        if(a == "綜合醫院"):
            print(x)
            print(y)
            print(z)
            print()

try:
    with connection.cursor() as cursor:
        sql = "INSERT INTO `HOSPITALINFO` (`name`, `address`, `phone number`, `type1) VALUES (%s, %s, %s, %s)"
        for x, y, z, a in zip(names, addr, phone, type):
            cursor.execute(sql, (x,y,z))

    connection.commit()

finally:
    connection.close()

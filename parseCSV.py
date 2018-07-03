import csv
import re
import pymysql.cursors

connection = pymysql.connect(host = "localhost",
                             user = "root",
                             password = "101dc101",
                             db = "hospitalApp",
                             charset = "utf8mb4",
                             cursorclass = pymysql.cursors.DictCursor)

count = 0;

with open("TaiwanHospitalInformation.csv", encoding = "utf-8") as file:
    reader = csv.reader(file, delimiter = ",")
    names = []
    addr = []
    phone = []
    for row in reader:
        names.append(row[1])
        addr.append(row[6])
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
    for x, y, z in zip(names, addr, phone):
        print(x)
        print(y)
        print(z)
        print()

try:
    with connection.cursor() as cursor:
        sql = "INSERT INTO `hositalInfo` (`name`, `address`, `phone number`) VALUES (%s, %s, %s)"
        for x, y, z in zip(names, addr, phone):
            cursor.execute(sql, (x,y,z))

    connection.commit()

finally:
    connection.close()
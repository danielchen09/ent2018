# ent2018
Database structure: 

DATABASE hospitalApp


|  --  TABLE users

       | --  COL id PRIMARY KEY
       | --  COL name VARCHAR(50)
       | --  COL birthDate DATE
       | --  COL username VARCHAR(50)
       | --  COL password VARCHAR(64)
       | --  COL phone VARCHAR(20)
| --  TABLE medHistory

       | --  COL id PRIMARY KEY
       | --  COL name VARCHAR(100)
       | --  COL username VARCHAR(50)
       | --  COL status VARCHAR(5)
       | --  COL startDate VARCHAR(4)
| --  TABLE medicine

       | --  COL id PRIMARY KEY
       | --  COL name VARCHAR(100)
       | --  COL username VARCHAR(50)
       | --  COL purpose VARCHAR(100)
       | --  COL frequency INTEGER
       | --  COL period VARCHAR(3)
       | --  COL ongoing BOOLEAN

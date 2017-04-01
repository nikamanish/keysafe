#!/usr/bin/python
import MySQLdb
from sklearn import tree

# connect
db = MySQLdb.connect(host="localhost", user="root", passwd="",
db="ks", unix_socket="/opt/lampp/var/mysql/mysql.sock")

cursor = db.cursor()

# execute SQL select statement
cursor.execute("SELECT * FROM flight_time")

# commit your changes
db.commit()

# get the number of rows in the resultset
numrows = int(cursor.rowcount)


data = []
value = []
# get and display one row at a time.
for x in range(0,numrows):
    row = cursor.fetchone()
    data.append([int(x) for x in row[3].split(",")])
    value.append(row[2])

clf = tree.DecisionTreeClassifier()
clf = clf.fit(data[:-1], value[:-1])
print(clf.predict_proba([data[-1]]))
print(clf.predict([data[-1]]))
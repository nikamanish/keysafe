#!/usr/bin/python
import MySQLdb
from sklearn.cluster import KMeans

# connect
db = MySQLdb.connect(host="localhost", user="root", passwd="",
db="ks", unix_socket="/opt/lampp/var/mysql/mysql.sock")

cursor = db.cursor()

# execute SQL select statement
cursor.execute("SELECT * FROM flight_time")

# get the number of rows in the resultset
numrows = int(cursor.rowcount)

data = []
n = 2
# get and display one row at a time.
for x in range(0,numrows):
    row = cursor.fetchone()
    data.append([int(x) for x in row[3].split(",")])

kmeans= KMeans(n_clusters= n, random_state=0).fit(data)

print(kmeans.labels_)

cursor.execute("SELECT * FROM dwell_time")
# commit your changes
db.commit()

numrows = int(cursor.rowcount)

data = []
value = []
n = 2
# get and display one row at a time.
for x in range(0,numrows):
    row = cursor.fetchone()
    data.append([int(x) for x in row[3].split(",")])

kmeans= KMeans(n_clusters= n, random_state=0).fit(data)

print(kmeans.labels_)
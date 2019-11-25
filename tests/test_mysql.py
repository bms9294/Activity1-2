import pymysql
import pytest

def mysql_connect():
    conn=pymysql.connect(host='127.0.0.1',
                         port=33060,
                         user='videos4u',
                         password='olah6aeQuie7Oishol4Eej6oofee3aeg',
                         database='videos4u_web')
    query = conn.cursor()
    return query


def test_database():
    query = mysql_connect()
    query.execute("SHOW DATABASES")
    test = query.fetchall()
    assert ('videos4u_web',) in test


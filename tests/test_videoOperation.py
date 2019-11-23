import requests
import requests.utils
import pytest
import pymysql

session = ""

def test_userLogin():
    global session
    data = {'username': 'jimstark', 'password': 'password1'}
    try:
        page = requests.post("https://localhost/core/login/login.php",data=data, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text
    session = page.headers["Set-Cookie"][8:136]
    
    

def test_verifySession():
    try:
        page = requests.get("https://localhost/core/session/challenge.php",cookies={"session": session} , verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text


#test_verifySession()

def uploadVideo():
    pass
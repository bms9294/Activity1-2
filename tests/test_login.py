import requests
import pytest
import pymysql

ADDRESS = "https://localhost/core/login/login.php"



def test_success():
    data = {"username": "jimstark","password": "password1"}
    try:
        page = requests.post(ADDRESS,data,verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text



def test_noPass():
    data = {"username": "jimstark"}
    try:
        page = requests.post(ADDRESS,data,verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": false, "message": "Empty Password!"}' in page.text

def test_wrongPass():
    data = {"username": "jimstark","password": "ohnohackerman!"}
    try:
        page = requests.post(ADDRESS,data,verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": false, "message": "Incorrect Login/Password!"}' in page.text

def test_noUsername():
    data = {"password": "password1"}
    try:
        page = requests.post(ADDRESS,data,verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": false, "message": "Empty Username!"}' in page.text

def test_wrongUsername():
    data = {"username": "jimsaaaatark","password": "password1"}
    try:
        page = requests.post(ADDRESS,data,verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": false, "message": "Incorrect Login/Password!"}' in page.text
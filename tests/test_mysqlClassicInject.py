import requests
import requests.utils
import pytest
import pymysql
import urllib3
urllib3.disable_warnings()


def test_classicSQLInjection():
    data = {'username': 'jimstark', 'password': 'password1'}
    try:
        page = requests.post("https://localhost/core/login/login.php", data=data, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text
    session = page.headers["Set-Cookie"][8:136]

    file = {'file': open("tests/VideoTest.mp4", 'rb')}
    inputData = {'filename': 'VideoTest'}
    try:
        page = requests.post("https://localhost/core/video/videoUpload.php", files=file, data=inputData, cookies={"session": session}, verify=False)
        data = page.json()
        videoPath = data['path']
    except:
        page = None    
    assert page != None
    assert '{"success": true' in page.text

    inputData = {'title': '(SELECT passhash FROM users WHERE username=\"jimstark\")', 'path': videoPath, 'description': 'This is a test video upload'}
    try:
        page = requests.post("https://localhost/core/video/finalize.php", data=inputData, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text


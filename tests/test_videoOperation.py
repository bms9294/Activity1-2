import requests
import requests.utils
import pytest
import pymysql
import urllib3
urllib3.disable_warnings()

session = ""
videoPath = ""



def mysql_connect():
    conn=pymysql.connect(host='127.0.0.1',
                         port=33060,
                         user='videos4u',
                         password='olah6aeQuie7Oishol4Eej6oofee3aeg',
                         database='videos4u_web')
    query = conn.cursor()
    return query

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
    


def test_uploadVideo():
    file = {'file': open("tests/VideoTest.mp4", 'rb')}
    inputData = {'filename': 'Video Test'}
    try:
        page = requests.post("https://localhost/core/video/videoUpload.php", files=file, data=inputData, cookies={"session": session}, verify=False)
    except:
        page = None    
    data = page.json()
    global videoPath
    videoPath = data['path']
    assert page != None
    assert '{"success": true' in page.text


def test_finalizeVideo():
    inputData = {'title': "'Video Test'", 'path': videoPath, 'description': 'This is a test video upload'}
    try:
        page = requests.post("https://localhost/core/video/finalize.php", data=inputData, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text

def getVideoID():
    query = mysql_connect()
    query.execute("SELECT videoID FROM videos WHERE pathToVideo=" + "'" + videoPath + "'")
    vid_id = query.fetchone()
    return vid_id[0]
        

def test_deleteVideo():
    idVal = getVideoID()
    print(idVal)
    inputData = {'video': idVal}
    try:
        page = requests.post("https://localhost/core/deleteVideo.php", data=inputData ,cookies={"session": session}, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text


### CLASSIC INJECTION TEST ###

def test_classicSQLInjection():
    global session
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
    except:
        page = None    
    data = page.json()
    global videoPath
    videoPath = data['path']
    
    assert page != None
    assert '{"success": true' in page.text

    inputData = {'title': '(SELECT passhash FROM users WHERE username=\"jimstark\")', 'path': videoPath, 'description': 'This is a test video upload'}
    try:
        page = requests.post("https://localhost/core/video/finalize.php", data=inputData, verify=False)
    except:
        page = None
    assert page != None
    assert '{"success": true}' in page.text


test_classicSQLInjection()
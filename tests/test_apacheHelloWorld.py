# Created by: bms9294
#
# Meant to test the "Hello World" web server for connectivity and proper content.


import pytest;
import requests;

#The testing class for the HelloWorld WebServer
#Address and port of the WebSite
ADDRESS = "http://localhost:80";

try:
    page = requests.get(ADDRESS,timeout=0.5);
except:
    page = None;


# Make sure the returned status code is 200 for success.
def test_Code():
    assert page.status_code == 200;

# Make sure the content of the site is HTML
def test_Header():
    #print(page.headers)
    assert 'text/html' in page.headers['content-type'];

# Make sure the page is displaying the correct content.
def test_Content():
    #print(page.text);
    assert "Single Row, <br />id: 3<br />name: jerry<br />birthday: 2019-11-05<br />" in page.text;
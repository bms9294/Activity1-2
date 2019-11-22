# Created by: bms9294
#
# Meant to test the "Hello World" web server for connectivity and proper content.


import pytest
import requests

#The testing class for the HelloWorld WebServer
#Address and port of the WebSite
ADDRESS = "https://localhost/core/login/login.php"

try:
    page = requests.get(ADDRESS,verify=False)
except:
    page = None


# Make sure the returned status code is 200 for success.
def test_Code():
    assert page.status_code == 200

# Make sure the content of the site is HTML
def test_Header():
    #print(page.headers)
    assert 'text/html' in page.headers['content-type']

# Make sure the page is displaying the correct content.
def test_Content():
    #print(page.text);
    assert '{"success": false, "message": "Empty Password!"}' in page.text


#print(page)
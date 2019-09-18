# Created by: bms9294
#
# Meant to test the "Hello World" web server for connectivity and proper content.


import pytest;
import requests;

#The testing class for the HelloWorld WebServer
class helloWorldTest(object):
    #Address and port of the WebSite
    ADDRESS = "http://localhost:80";


    # Get the content from the server for testing.
    def getContent(self):
        try:
            result = requests.get(self.ADDRESS,timeout=0.5);
        except:
            # Page probably didn't respond
            return False

        return result;

    # Make sure the returned status code is 200 for success.
    def testCode(self,page):
        assert page.status_code == 200;

    # Make sure the content of the site is HTML
    def testHeader(self,page):
        #print(page.headers)
        assert page.headers['content-type'] == 'text/html';

    # Make sure the page is displaying the correct content.
    def testContent(self,page):
        #print(page.text);
        assert "<h2>Hello World</h2>" in page.text;


    # Just run them all.
    def testAll(self):
        result = self.getContent();
        #Make sure the GET request was successful.
        assert result != False;
        self.testCode(result);
        self.testHeader(result);
        self.testContent(result);
        
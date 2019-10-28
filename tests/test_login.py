import pytest;
import requests;

ADDRESS = "http://localhost:80";

def requesting():         
          r = requests.post(ADDRESS, data=values)
          
def test_Correctlogin():
          requesting()
          values = {'username': 'user',
                    'password': 'pass'}
          
def test_FailedUserLogin():
          requesting()
          values = {'username': 'wronguser',
                    'password': 'pass'}
          
def test_FailedPassLogin():
          requesting()
          values = {'username': 'user',
                    'password': 'wrongpass'}

# check r against something we set later

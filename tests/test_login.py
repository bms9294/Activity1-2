import pytest;
import requests;

ADDRESS = "http://localhost:80";


def test_Correctlogin():
          values = {'username': 'user',
                    'password': 'pass'}
          
def test_FailedUserLogin():
          values = {'username': 'wronguser',
                    'password': 'pass'}
          
def test_FailedPassLogin():
          values = {'username': 'user',
                    'password': 'wrongpass'}
          
r = requests.post(ADDRESS, data=values)
# check r against something we set later

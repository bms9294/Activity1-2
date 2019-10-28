import pytest;
import requests;

ADDRESS = "http://localhost:80";


def test_Correctlogin():
          values = {'username': 'user',
                    'password': 'pass'}
          
def test_Failedlogin():
          values = {'username': 'wrong',
                    'password': 'alsowrong'}
          
r = requests.post(ADDRESS, data=values)
# check r against something we set later

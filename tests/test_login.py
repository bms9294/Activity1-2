import pytest;
import requests;

ADDRESS = "http://localhost:80";


def test_Correctlogin():
          values = {'username': 'user',
                    'password': 'pass'}
          
r = requests.post(ADDRESS, data=values)


# import requests
# import requests.utils
# import pytest
# import pymysql

# ADDRESS = "https://localhost/core/login/login.php"


# def test_userLogin():
#     s = requests.Session()
#     data = {'username': 'jimstark', 'password': 'password1'}
#     page = s.post(ADDRESS, data, verify=False)
#     print(page.text)
#     print(s.cookies)
#     try:
#         page = s.get("https://localhost/core/session/challenge.php", verify=False)
#     except:
#         page = None

#     print(page.text)
#     #assert page != None
#     #assert '{"success": true}' in page.text

# test_userLogin()
# #test_verifySession()

# def uploadVideo():
#     pass
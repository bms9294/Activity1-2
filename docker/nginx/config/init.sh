sslValid=true
SSLDIR=/var/www/ssl
CERT=/var/www/ssl/videos4u.crt
KEY=/var/www/ssl/videos4u.key
if test -e "$SSLDIR";then
    echo "Certificate Directory present..."
else
    mkdir /var/www/ssl
    sslValid=false
fi
if test -f "$CERT"; then
    echo "Server Certificate Presesnt..."
else
    sslValid=false
fi
if test -f "$KEY"; then
    echo "Server Key Present..."
else
    sslValid=false
fi

if $sslValid ; then
    echo "Server configured using provided cert and key."
else
    echo "Generating Self signed certificate..."
    openssl req -new -newkey rsa:4096 -days 365 -nodes -x509 \
    -subj "/C=US/''=Denial/L=''/O=Dis/CN=videos4u" \
    -keyout /var/www/ssl/videos4u.key  -out /var/www/ssl/videos4u.crt
fi


/./usr/bin/supervisord -n
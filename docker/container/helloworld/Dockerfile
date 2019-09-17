# Created by: bms9294
#
# For building the Hello World web server.

FROM httpd
RUN apt-get update && apt-get -y upgrade
COPY ./html/index.html /usr/local/apache2/htdocs/
COPY ./config/httpd.conf /usr/local/apache2/conf/httpd.conf
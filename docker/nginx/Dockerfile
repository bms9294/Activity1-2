FROM richarvey/nginx-php-fpm
RUN apk update && apk upgrade
RUN apk add php7-pdo
ADD ./config/init.sh /init.sh
COPY ./config/default.conf /etc/nginx/sites-enabled/default.conf
COPY ./config/videos4u.conf /etc/nginx/sites-enabled/videos4u.conf
RUN chmod +x /init.sh


CMD ["/bin/bash", "/init.sh"]
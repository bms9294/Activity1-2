FROM richarvey/nginx-php-fpm
RUN apk update && apk upgrade
RUN apk add php7-pdo
RUN apk add ffmpeg
ADD ./config/init.sh /init.sh
COPY ./config/default.conf /etc/nginx/sites-enabled/default.conf
COPY ./config/videos4u.conf /etc/nginx/sites-enabled/videos4u.conf
COPY ./config/php.ini /usr/local/etc/php/conf.d/docker-vars.ini
RUN chmod +x /init.sh
RUN mkdir /ffmpeg && cd /ffmpeg && composer require php-ffmpeg/php-ffmpeg
RUN  chgrp nginx /tmp/

CMD ["/bin/bash", "/init.sh"]
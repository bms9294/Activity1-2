FROM ubuntu
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get -y upgrade
RUN apt-get install -y apache2
RUN apt-get install -y software-properties-common
RUN add-apt-repository -y ppa:ondrej/php

RUN apt-get update
RUN apt-get install -y php7.3 php7.3-cli php7.3-mysql php7.3-gd php7.3-imagick php7.3-recode php7.3-tidy php7.3-xmlrpc php7.3-common php7.3-curl php7.3-mbstring php7.3-xml php7.3-bcmath php7.3-bz2 php7.3-intl php7.3-json php7.3-readline php7.3-zip
RUN apt-get install -y libapache2-mod-php7.3
RUN a2enmod php7.3

COPY ./config/apache2.conf /etc/apache2/apache2.conf
COPY ./config/videos4u.conf /etc/apache2/sites-enabled/videos4u.conf
RUN a2dissite 000-default
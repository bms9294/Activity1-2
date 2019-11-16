FROM mysql
ENV DEFAULT-AUTHENTICATION-PLUGIN=mysql_native_password
RUN apt-get update && apt-get -y upgrade
COPY ./config/setup.sh /docker-entrypoint-initdb.d/setup.sh
COPY ./config/videos4uweb.sql /docker-entrypoint-initdb.d/videos4uweb.sql
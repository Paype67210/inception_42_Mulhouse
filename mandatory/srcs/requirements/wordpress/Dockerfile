FROM debian:bullseye

EXPOSE 9000

# Etiquettes d'identification
LABEL author="pdeson <pdeson@student.42mulhouse.fr>"
LABEL name="inception-wordpress"
LABEL description="This is a wordpress docker for the inception project"
LABEL version="5.0"

ARG	PHPPATH=/etc/php/7.4/fpm

# Install mariadb
RUN apt-get update && \
    apt-get install -y --no-install-recommends --no-install-suggests \
    wget iputils-ping \
    php7.4-fpm php7.4-mysql \
    ca-certificates && \
    rm -rf /var/lib/apt/lists/*

RUN service php7.4-fpm stop

COPY /conf/www.conf ${PHPPATH}/pool.d/

RUN	sed -i 's/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/g' ${PHPPATH}/php.ini && \
	sed -i "s/listen = \/run\/php\/php$PHP_VERSION_ENV-fpm.sock/listen = 9000/g" ${PHPPATH}/pool.d/www.conf && \
	sed -i 's/;listen.mode = 0660/listen.mode = 0660/g' ${PHPPATH}/pool.d/www.conf && \
	sed -i 's/;daemonize = yes/daemonize = no/g' ${PHPPATH}/pool.d/www.conf

RUN	mkdir -p /run/php/ && \
	mkdir -p /var/run/php/ && \
	mkdir -p /var/www/html/

COPY conf/wp-config.php /tmp/

COPY tools/setup_wp.sh /bin/
RUN chmod +x /bin/setup_wp.sh

CMD ["setup_wp.sh", "php-fpm7.4", "--nodaemonize"]
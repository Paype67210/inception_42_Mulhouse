FROM debian:bullseye

EXPOSE 80

# Etiquettes d'identification
LABEL author="pdeson <pdeson@student.42mulhouse.fr>"
LABEL description="This is an Adminer container for the inception project"
LABEL version="1.0"

# Install packages
RUN apt-get update && apt-get install -y --no-install-recommends --no-install-suggests \
	php-cli php-cgi php-fpm php-mysql php-json \
	curl unzip wget apache2 libapache2-mod-php \	
	adminer \
	dumb-init \
	&& rm -rf /var/lib/apt/lists/*

COPY ./conf/000-default.conf /etc/apache2/sites-available/

# Configurer Apache pour servir Adminer
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && a2enmod php7.4 \
    && a2enmod rewrite

#Start the server
RUN service apache2 start && a2enconf adminer.conf

# Surveillance du PID1
ENTRYPOINT ["/usr/bin/dumb-init", "--"]

CMD ["apachectl", "-D", "FOREGROUND"]

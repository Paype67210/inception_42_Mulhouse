#!/bin/bash

FILE=wordpress
cd /var/www/html

if [ -d "$FILE" ]; then
    echo "Wordpress already installed"
else
    echo "Wordpress not installed"
    mkdir -p wordpress
    cd wordpress
    # Install wordpress CLI
    wget --no-check-certificate https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
	chmod +x wp-cli.phar && \
	mv wp-cli.phar /usr/local/bin/wp
    wp --allow-root core download

    sleep 5
    wp  --allow-root config create \
        --dbname=$SQL_DATABASE \
        --dbuser=$WP_USER \
        --dbpass=$WP_PASSWORD \
        --dbhost=$DBHOST
    
    # Remplacer wp-config.php par le fichier personnalisé
    cp /tmp/wp-config.php /var/www/html/wordpress/wp-config.php
    echo "Custom wp-config.php applied."
    
    sleep 5

    wp  --allow-root core install \
        --url=$WP_URL \
        --title=$WP_TITLE \
        --admin_user=$WP_ADMIN_USER \
        --admin_password=$WP_ADMIN_PASSWORD \
        --admin_email=$WP_ADMIN_EMAIL
    
    wp  --allow-root user create $WP_USER $WP_EMAIL \
        --user_pass=$WP_USER_PASSWORD \
        --role=$WP_ROLE
    
    # Installation d'un thème un peu plus fun (A CHANGER)
    wp --allow-root theme install raft --activate 

    # Installer et activer le plugin Redis Object Cache
    wp plugin install redis-cache --activate --allow-root --path=/var/www/html/wordpress

    # Activer le cache Redis
    wp redis enable --allow-root --path=/var/www/html/wordpress
    echo "END WP & Redis config"
fi

exec $@
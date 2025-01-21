FROM debian:bullseye

EXPOSE 3306

# Etiquettes d'identification
LABEL author="pdeson <pdeson@student.42mulhouse.fr>"
LABEL name="inception-mariadb"
LABEL description="This is a mariadb docker for the inception project"
LABEL version="5.0"

# Install mariadb
RUN apt-get update && \
    apt-get install -y --no-install-recommends --no-install-suggests \
    mariadb-server iputils-ping && \
    rm -rf /var/lib/apt/lists/*

# Copie des fichiers de configuration
COPY conf/50-server.cnf /etc/mysql/mariadb.conf.d/

# Copie du script de creation de la database
COPY tools/create_db.sh /bin/
RUN chmod +x /bin/create_db.sh

CMD ["create_db.sh", "mysqld_safe"]

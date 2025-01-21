FROM debian:bullseye

# Exposer le port par défaut de Redis
EXPOSE 6379

# Etiquettes d'identification
LABEL author="pdeson <pdeson@student.42mulhouse.fr>"
LABEL name="inception-redis"
LABEL description="This is a redis (cache for WP) docker for the inception project"
LABEL version="2.0"

# Installer les depnedamces
RUN apt-get update && apt install -y --no-install-recommends --no-install-suggests \
    vim iputils-ping redis \
    dumb-init \
	&& rm -rf /var/lib/apt/lists/*

# Copier le fichier de configuration par défaut
COPY ./conf/redis.conf /etc/redis/

# Définir les permissions du répertoire Redis
RUN chown -R redis:redis /etc/redis

# Surveillance du PID1
ENTRYPOINT ["/usr/bin/dumb-init", "--"]

CMD ["redis-server",  "--protected-mode", "no"]

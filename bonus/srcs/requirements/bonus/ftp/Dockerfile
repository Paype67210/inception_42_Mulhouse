FROM debian:bullseye

# Exposer le port FTP
EXPOSE 20 21 40000-40009

# Etiquettes d'identification
LABEL author="pdeson <pdeson@student.42mulhouse.fr>"
LABEL name="inception-ftp"
LABEL description="This is a ftp-server docker for the inception project"
LABEL version="3.0"

RUN apt-get update && apt install -y --no-install-recommends --no-install-suggests \
    vim iputils-ping vsftpd \
    dumb-init \
	&& rm -rf /var/lib/apt/lists/*

# Ceer le dossier des utilisateurs
RUN mkdir -p /var/run/vsftpd/empty

# Copie de la configuration vsftpd
COPY ./conf/vsftpd.conf /tmp/

# Script de démarrage
COPY ./tools/init.sh /tmp/
RUN chmod +x /tmp/init.sh

# Surveillance du PID1
ENTRYPOINT ["/usr/bin/dumb-init", "--"]

CMD ["/tmp/init.sh"]
FROM debian:bullseye

EXPOSE 443

# Etiquettes d'identification
LABEL author="pdeson <pdeson@student.42mulhouse.fr>"
LABEL description="This is a nginx server for the inception project"
LABEL version="5.0"

RUN apt-get update && \
apt-get install -y --no-install-recommends --no-install-suggests \
nginx iputils-ping \
openssl \
dumb-init &&\
rm -rf /var/lib/apt/lists/*

ARG CERT_FOLDER CERTIFICATE KEY COUNTRY STATE LOCALITY ORGANIZATION UNIT COMMON_NAME

# Creation des certificats autusignes et des repertoires necessaires au stockage
RUN mkdir -p ${CERT_FOLDER} && \
	openssl req -x509 -nodes \
	-keyout ${KEY} \
	-out ${CERTIFICATE} \
	-subj "/C=${COUNTRY}/ST=${STATE}/L=${LOCALITY}/O=${ORGANIZATION}/OU=${UNIT}/CN=${COMMON_NAME}"

# Copie des fichiers de configuration
COPY conf/nginx.conf /etc/nginx/
COPY conf/server.conf /etc/nginx/conf.d/

RUN mkdir -p /var/www/
RUN chown -R www-data:www-data /var/www/

# Surveillance du PID1
ENTRYPOINT ["/usr/bin/dumb-init", "--"]

CMD ["nginx", "-g", "daemon off;"]


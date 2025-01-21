FROM debian:bullseye

EXPOSE 1313

# Etiquettes d'identification
LABEL author="pdeson <pdeson@student.42mulhouse.fr>"
LABEL description="This is a static-site container for the inception project"
LABEL version="1.0"

# Install busybox
RUN apt-get update && apt-get install -y \
    busybox \
    dumb-init \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /var/static/phd/

# create new static-site
COPY tools/index.html /var/static/phd/
COPY tools/bonne-annee.jpg /var/static/phd/

RUN	chown -R root:root /var/static/phd && \
	chmod -R 755 /var/static/phd/

WORKDIR /var/static/phd

# Surveillance du PID1
ENTRYPOINT ["/usr/bin/dumb-init", "--"]

CMD ["busybox", "httpd", "-f", "-p", "1313"]
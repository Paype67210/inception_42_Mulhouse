FROM debian:bullseye

# Exposer le port par défaut de Redis Commander
EXPOSE 8081

# Etiquettes d'identification
LABEL author="pdeson <pdeson@student.42mulhouse.fr>"
LABEL description="This is a redis-commander container for the inception project"
LABEL version="1.0"

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y --no-install-recommends --no-install-suggests \
    unzip \
    nodejs \
    npm \
    dumb-init \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installation globale de redis-commander via npm
RUN npm install -g redis-commander

# Surveillance du PID1
ENTRYPOINT ["/usr/bin/dumb-init", "--"]

# Commande pour démarrer Redis Commander avec les bonnes options
CMD ["redis-commander", "--redis-host", "redis", "--redis-port", "6379"]

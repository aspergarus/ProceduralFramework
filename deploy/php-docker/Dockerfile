# Use a PHP base image
FROM php:7.4-cli

# Set the working directory inside the container
WORKDIR /app

# COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# RUN install-php-extensions  \
    #apcu  \
    #exif  \
    #gd  \
    #intl  \
    # pdo_mysql  \
    #opcache  \
    #zip  \
    #xdebug  \
    #dba

RUN apt-get update && apt-get install -y \
    libqdbm-dev \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure dba --with-qdbm=/usr \
    && docker-php-ext-install dba

EXPOSE 1111

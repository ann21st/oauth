FROM php:8.2-cli-alpine3.20 AS environ

RUN apk update && apk add --no-cache \
    curl-dev \
    libzip-dev \
    oniguruma-dev \
    openssl \
    openssl-dev \
    icu-dev \
    libxml2-dev \
    autoconf \
    g++ \
    make \
    git

RUN docker-php-source extract \
    && docker-php-ext-enable opcache \
    && docker-php-ext-install -j$(nproc) \
        curl \
        mbstring \
        mysqli \
        pdo_mysql \
        zip \
    && docker-php-ext-configure pdo_mysql && docker-php-ext-install pdo_mysql \
    && docker-php-source delete \
    && apk del autoconf g++ make


RUN cd /usr/src && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /usr/src/app

EXPOSE 8888

CMD ["php", "-S", "0.0.0.0:8888"]

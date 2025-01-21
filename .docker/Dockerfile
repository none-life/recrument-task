ARG phpVersion=8.1
ARG COMPOSER_VERSION=2.2

FROM php:$phpVersion AS php

ENV PATH="/var/www/html/vendor/bin:${PATH}"

RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y git zip unzip libzip-dev libxml2 libxml2-dev \
      libxslt-dev libsodium-dev libbz2-dev libpq-dev msmtp graphviz \
    && docker-php-ext-install zip xsl sodium bz2

RUN docker-php-ext-install opcache

RUN echo "opcache.memory_consumption=256" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.interned_strings_buffer=16" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini \
    && echo "opcache.max_accelerated_files=16229" >> /usr/local/etc/php/conf.d/docker-php-ext-opcache.ini

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN if [ `echo "$COMPOSER_VERSION" | grep -o "[0-9]\+" | wc -l` -eq 3 ]; then \
        php composer-setup.php --version=$COMPOSER_VERSION; \
    else \
        php composer-setup.php --$COMPOSER_VERSION; \
    fi
RUN rm composer-setup.php && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer

COPY installPhpXdebug /usr/bin/installPhpXdebug
RUN /usr/bin/installPhpXdebug \
    && docker-php-ext-enable xdebug

RUN echo "xdebug.mode=off" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.trigger_value=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=true" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_discovery_header=HTTP_X_FORWARDED_FOR" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN mkdir /opt/phpstorm-coverage \
    && chown www-data:www-data /opt/phpstorm-coverage

WORKDIR /var/www/html

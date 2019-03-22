#FROM php:7.2-apache
#
#COPY php.ini /usr/local/etc/php/
#
#RUN docker-php-ext-install mysqli
#RUN docker-php-ext-install mbstring
#RUN apt-get update \
#    && apt-get install -y libpcre3 libpcre3-dev \
#    && pecl install oauth \
#    && touch /usr/local/etc/php/conf.d/oauth.ini \
#    && echo 'extension=oauth.so' >> /usr/local/etc/php/conf.d/oauth.ini


FROM php:7.2.7-fpm-alpine3.7
#COPY php.ini /usr/local/etc/php/
RUN apk update; \
    apk upgrade;
RUN docker-php-ext-install mysqli

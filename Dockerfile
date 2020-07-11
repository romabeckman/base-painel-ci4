FROM php:7.4-apache
WORKDIR /var/www/html/
RUN apt-get update
#COPY . /var/www/html/
RUN a2enmod rewrite
RUN chmod 755 -R /var/www/html/
RUN docker-php-ext-install pdo pdo_mysql mysqli

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

#RUN pecl install xdebug && docker-php-ext-enable xdebug
#RUN echo "xdebug.remote_enable=on" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null && \
#    echo "xdebug.remote_handler=dbgp" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null && \
#    echo "xdebug.remote_port=9000" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null && \
#    echo "xdebug.remote_host=host.docker.internal" | tee -a /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini > /dev/null

#RUN apt-get install -y zip unzip
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && composer install

EXPOSE 9000
EXPOSE 80
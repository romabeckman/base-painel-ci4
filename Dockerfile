FROM php:7.4-apache
WORKDIR /var/www/html/
#COPY . /var/www/html/
RUN a2enmod rewrite
RUN apt-get update
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN apt-get install -y zip unzip
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN chmod 755 -R /var/www/html/
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && composer install
#CMD php -S 0.0.0.0:8080 -t public/
EXPOSE 80
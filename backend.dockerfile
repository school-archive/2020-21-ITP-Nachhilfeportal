FROM library/php:7.3-apache
RUN docker-php-ext-install pdo_mysql
RUN apt-get update -y && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev git
#RUN apt-get install wget php-cli php-zip unzip

RUN pecl install xdebug && docker-php-ext-enable xdebug

#RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
#RUN docker-php-ext-install -j$(nproc) gd

RUN a2enmod rewrite

RUN chown www-data /var/www/html

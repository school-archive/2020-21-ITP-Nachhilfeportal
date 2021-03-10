FROM library/php:7.3-apache
RUN docker-php-ext-install pdo_mysql
RUN apt-get update -y && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd
RUN chown www-data /var/www/html

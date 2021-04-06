FROM library/php:7.3

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN apt-get update -y && apt-get install -y git unzip zip

CMD ["composer", "install", "--working-dir", "/var/www/html"]
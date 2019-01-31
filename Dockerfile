FROM php:7.1
MAINTAINER yuana <andhika@yuana.id>
WORKDIR /app
ADD src /app/src
ADD views /app/views
ADD public /app/public
ADD db /app/db
ADD composer.json /app
ADD composer.lock /app
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
	apt-get update -y && \
	apt-get install -y libpng-dev sqlite3 libsqlite3-dev zip unzip git && \
	docker-php-ext-install gd mbstring pdo pdo_sqlite zip && \
	composer install
RUN touch /usr/local/etc/php/conf.d/error-log.ini \
    && echo "display_errors = On;\nlog_errors = On;\nerror_log = /dev/stderr;\n" >> /usr/local/etc/php/conf.d/error-log.ini
CMD php -S  0.0.0.0:3000 -t public
EXPOSE 3000


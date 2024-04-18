FROM ejklock/php-fpm:8.1

USER root

WORKDIR /var/www/app

COPY  . .

RUN cp .env.example .env

RUN chown -R app:app .

RUN composer install 

RUN php artisan key:generate

RUN php artisan jwt:secret --force

USER app

EXPOSE 8000




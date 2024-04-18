## Prerequisites

1. Docker and Docker Compose installed

# To run the project in production mode, follow these steps

1. Open a terminal and run `docker-compose -f compose.prd.yml up`
2. Run migrations with `php artisan migrate`
3. Finally, access the application at `http://localhost:8000`

Please note that the project will be run in production mode, without reflecting code changes in realtime.

# To run the project in development mode (with code changes in realtime on the fly), follow these steps

1. Open a terminal and run `docker-compose up`
2. Run `cp .env.example .env`
3. Run `composer install`
4. Run `php artisan key:generate`
5. Run `php artisan jwt:secret`
6. Run migrations with `php artisan migrate`
7. Finally, access the application at `http://localhost:8000`

Please note that the project will be run in development mode, with reflecting code changes in realtime. In Windows or MacOS, using this mode can be a bit slow because volumes mapping is a low performance.

WEB SITE DẬY TIN HỌC LỚP 11

REQUIRED:
Docker, Docker compose.

HOW TO RUN WEBSITE:

`#0, clone and cd tin-hoc-lop-11`

`#1, cp .env.dev .env`

`#2, open command and run "docker run --rm -v $(pwd):/app composer install"`

`#3, wait done and run "docker-compose up"`

`#4, open new command and run "docker-compose exec app php artisan migrate"`

`#4, and then run "docker-compose exec app php artisan passport:install"`


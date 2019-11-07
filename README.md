WEB SITE DẬY TIN HỌC LỚP 11

REQUIRED:
Docker, Docker compose.

HOW TO RUN WEBSITE:

`#1, clone and cd tin-hoc-lop-11`

`#2, open command and run "docker run --rm -v $(pwd):/app composer install && docker-compose up"`

`#3, open new command and run "docker-compose exec app php artisan migrate && php artisan passport:install"`


# Intermediate Gateway

Pawn Shop....

## General Requirements
1. PHP 7.2.5+ (suggest 7.2.5)
2. MySQL 5.7+ (suggest 7.1.3)
3. composer
4. npm

## Quick start
```bash
composer install

npm install

######################## FOR FIRST TIME ########################################
//rename file ".env.example"  to ".env"
//update DB_DATABASE={your database}
//update DB_USERNAME={your username}
//update DB_PASSWORD={your password}

################################# END ###########################################


php artisan key:generate

composer dump-auto

php artisan migrate --seed

npm run dev

php artisan config:cache
```
## Run app
```bash
php artisan serve --port={your port}

php artisan route:list  //list all route in app
```
## License
[MIT](https://choosealicense.com/licenses/mit/)

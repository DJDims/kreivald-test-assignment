# Installation
Clone project
```
git clone https://github.com/DJDims/kreivald-test-assignment
```

Install dependecies
```
composer install
```

Create database

Copy `.env.example` to `.env`

- Windows
    ```
    copy .env.example .env
    ```

- Linux
    ```
    cp .env.example .env
    ```

Fill `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
TINIFY_API_KEY=
```

Run migrations
```
php artisan migrate
```

Run project
```
php artisan serve
```

Seed database
```
php artisan db:seed
```

## Simple Chat Laravel - Vue.js


&nbsp; Install PHP dependecies
```bash
composer install
```

&nbsp; Install NPM dependecies
```bash
npm install
```

&nbsp; Setup Config
```bash
cp .env.example .env

php artisan key:generate
```

&nbsp; Database Config
```bash
create db_chat

php artisan migrate

php artisan db:seed (optional)
```

&nbsp; Run Project
```bash
php artisan serve
```

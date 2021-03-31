MultilingualBlog
========================

Installation
------------

Download MultilingualBlog and run these commands:

```bash
$ cd symfony002blog/
$ composer install
$ npm install
$ npm run build
```

Database setup

You need to override an DATABASE_URL in a .env file:
After that run these commands:

```bash
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
$ php bin/console doctrine:fixtures:load
```

Usage
-----

Run `php -S localhost:8000 -t public/` and access the application in your
browser at the given URL (<https://localhost:8000> by default):

Test users:  
admin@example.com  pwd: admin@2020  
manager@example.com  pwd: manager@2020  
user@example.com  pwd: user@2020  

Unit Tests:
-----

```bash
$ php bin/console doctrine:fixtures:load --env=test

$ ./vendor/bin/phpunit --configuration phpunit.xml.dist --colors --verbose --testdox
$ ./vendor/bin/phpunit --configuration phpunit.xml.dist --colors --verbose App\Tests\AccumCollection\AbstractAccumCollection tests/AccumCollection/AbstractAccumCollectionTest.php
```
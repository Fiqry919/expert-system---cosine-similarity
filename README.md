## What inside?

-   Laravel ^8.x - [Laravel](https://laravel.com/docs/8.x/).
-   Bootstrap ^4.6 - [Bootstrap](https://getbootstrap.com/docs/4.6/getting-started/introduction/).

## About

this is an expert system application to diagnose 'whatever you want' disease with 2 methods that can be used:

-   cosine similarity - [Cosine Similarity](https://en.wikipedia.org/wiki/Cosine_similarity).
-   forward chaining
    before it can be used you are required to add disease data and symptom data, then you can create dummy data using a seeder.

## How to use?

Install all dependency required.

```shell
$ composer install
```

Install all node module required.

```shell
$ npm install && npm run dev
```

Generate app key, configure `.env` file and do migration.

```shell
# create copy of .env
$ cp .env.example .env

# create laravel key
$ php artisan key:generate

# run migration
$ php artisan migrate
```

For seeders, make sure you are login and create disease data and symptom data

```shell
# Run seeder
$ php artisan db:seed
```

Enjoy, happy learning

# php-docker

## Setup

Rename `.env.dist` to `.env` and create your custom values.

```
composer install
docker compose up -d
```

## Doctrine

Run Doctrine commands inside the application container's /var/www directory.

```
cd ../
php vendor/bin/doctrine orm:schema-tool:create --dump-sql
```

https://www.slimframework.com/docs/v4/cookbook/database-doctrine.html

## Browser

View application in the browser at `localhost:8080`.
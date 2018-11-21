# Laravel HttpAuth

## Installation

First, require the package using Composer:

```shell
composer require merkeleon/laravel-httpauth
```

Add to your config/app.php providers section

```php
Merkeleon\Laravel\HttpAuth\Providers\HttpAuthServiceProvider::class,
```

After this actions you easily can create HttpAuth on your site:

```shell
php artisan http-auth:user:make
```

You can also enable redirect from your site to a third-party resource:

```shell
php artisan http-auth:redirect:make
```

## Examples

Soon...
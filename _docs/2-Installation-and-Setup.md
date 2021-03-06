# 2. Installation

## Composer

You can install this package via [Composer](http://getcomposer.org/) by running this command: `composer require arcanedev/localization`.

Or by adding the package to your `composer.json`.

```json
{
    "require": {
        "arcanedev/localization": "0.6.*"
    }
}
```

Then install it via `composer install` or `composer update`.

## Laravel

### Setup

Once the package is installed, you can register the service provider in `config/app.php` in the `providers` array:

```php
'providers' => [
    ...
    Arcanedev\Localization\LocalizationServiceProvider::class,
],
```

> No need to register the Localization facade, it's done automagically.

##### Now you need to update your Http Kernel to use the Localization Router.

```php
// app/Http/Kernel.php
<?php namespace App\Http;

//...

class Kernel extends HttpKernel
{
    // Localization Trait
    use \Arcanedev\Localization\Traits\LocalizationKernelTrait;

    // Your middleware(s) here
}
```

### Artisan commands

To publish the config &amp; view files, run this command:

```bash
php artisan vendor:publish --provider="Arcanedev\Localization\LocalizationServiceProvider"
```

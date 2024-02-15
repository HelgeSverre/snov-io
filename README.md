<p align="center"><img src="./art/header.png"></p>

# Laravel Client for Snov.io

[![Latest Version on Packagist](https://img.shields.io/packagist/v/helgesverre/snov-io.svg?style=flat-square)](https://packagist.org/packages/helgesverre/snov-io)
[![Total Downloads](https://img.shields.io/packagist/dt/helgesverre/snov-io.svg?style=flat-square)](https://packagist.org/packages/helgesverre/snov-io)

## Installation

You can install the package via composer:

```bash
composer require helgesverre/snov-io
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="snov-io"
```

This is the contents of the published config file:

```php
return [
    'client_id' => env('SNOV_CLIENT_ID'),
    'client_secret' => env('SNOV_CLIENT_SECRET'),
];
```

# Development - Code generation

## Generate API Specification

Snov.io does not have an API specification publicly available, however their API docs are fairly structured and can be
scraped to generate something resembling an API spec that can be used to auto-generate parts of this SDK.

## Run scraper

```shell
php ./bin/generate.php
php ./bin/codegen.php
composer format 
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


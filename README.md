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

## Code generation

This SDK is mostly auto-generated from the Snov.io API documentation.

Run code generation with the composer script `codegen` using this command:

```shell
composer codegen 
```

Which runs these tasks:

```shell
# Generate the API spec
php ./bin/generate.php

# Generate the Resource and Request classes from the API spec
php ./bin/codegen.php

# Format the generated code
composer format 
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


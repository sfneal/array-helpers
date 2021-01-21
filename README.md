# PHP Array Helpers

[![Packagist PHP support](https://img.shields.io/packagist/php-v/sfneal/array-helpers)](https://packagist.org/packages/sfneal/array-helpers)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/sfneal/array-helpers.svg?style=flat-square)](https://packagist.org/packages/sfneal/array-helpers)
[![Build Status](https://travis-ci.com/sfneal/array-helpers.svg?branch=master&style=flat-square)](https://travis-ci.com/sfneal/array-helpers)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sfneal/array-helpers/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sfneal/array-helpers/?branch=master)
[![StyleCI](https://github.styleci.io/repos/294210716/shield?branch=master)](https://github.styleci.io/repos/294210716?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/sfneal/array-helpers.svg?style=flat-square)](https://packagist.org/packages/sfneal/array-helpers)

Array helpers for PHP applications.

## Installation

You can install the package via composer:

```bash
composer require sfneal/array-helpers
```

In order to autoload to the helper functions add the following path to the autoload.files section in your composer.json.

```json
"autoload": {
    "files": [
        "vendor/sfneal/array-helpers/src/arrays.php"
    ]
},
```

## Usage

Here's an example use of the arrayRemoveKeys method.

``` php
$array = ['red' => 36, 'black' => 88, 'white' => 72];

// Remove a key from the array
use Sfneal\Helpers\Arrays\ArrayHelpers;
(new ArrayHelpers($array))->arrayRemoveKeys('red');
>>> ['black' => 88, 'white' => 72,];
```

### Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email stephen.neal14@gmail.com instead of using the issue tracker.

## Credits

- [Stephen Neal](https://github.com/sfneal)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).

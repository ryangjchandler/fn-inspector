# A utility package that helps inspect functions in PHP.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ryangjchandler/fn-inspector.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/fn-inspector)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/fn-inspector/run-tests?label=tests)](https://github.com/ryangjchandler/fn-inspector/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/fn-inspector/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ryangjchandler/fn-inspector/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ryangjchandler/fn-inspector.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/fn-inspector)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support development

If you would like to support the on going maintenance and development of this package, please consider [sponsoring me on GitHub](https://github.com/sponsors/ryangjchandler).

## Installation

You can install the package via composer:

```bash
composer require ryangjchandler/fn-inspector
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="RyanChandler\FnInspector\FnInspectorServiceProvider" --tag="fn-inspector-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="RyanChandler\FnInspector\FnInspectorServiceProvider" --tag="fn-inspector-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$skeleton = new RyanChandler\FnInspector();
echo $skeleton->echoPhrase('Hello, world!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ryan Chandler](https://github.com/ryangjchandler)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

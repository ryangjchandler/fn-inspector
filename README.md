# A utility package that helps inspect functions in PHP.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ryangjchandler/fn-inspector.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/fn-inspector)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/fn-inspector/run-tests?label=tests)](https://github.com/ryangjchandler/fn-inspector/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ryangjchandler/fn-inspector/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ryangjchandler/fn-inspector/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ryangjchandler/fn-inspector.svg?style=flat-square)](https://packagist.org/packages/ryangjchandler/fn-inspector)

This package provides some utilities for inspecting functions (callables) in PHP. You can use it to find parameters, return types and more.

## Support development

If you would like to support the on going maintenance and development of this package, please consider [sponsoring me on GitHub](https://github.com/sponsors/ryangjchandler).

## Installation

You can install the package via Composer:

```bash
composer require ryangjchandler/fn-inspector
```

## Usage

You can create a new instance of `FnInspector` by calling `FnInspector::new()` and passing a `string`, `array` or `callable`.

```php
use RyanChandler\FnInspector\FnInspector;

$inspector = FnInspector::new('strlen');
$inspector = FnInspector::new(function () {});
$inspector = FnInspector::new([MyClass::class, 'staticMethod']);
$inspector = FnInspector::new([MyClass::class, 'instanceMethod']);
```

### Return Type

You can retrieve the return type of a function by calling the `returnType` method.

```php
$returnType = FnInspector::new(function (): void {})
    ->returnType()
    ->getName();

echo $returnType; // `void`
```

### Number of Parameters

You can retrieve the number of parameters by calling the `numberOfParameters` method.

```php
$params = FnInspector::new(function ($name): void {})
    ->numberOfParameters();

echo $params; // `1`
```

#### Number of Required Parameters

If you're only interested in required parameters, you can provide a `bool` to the `numberOfParameters` method.

```php
$params = FnInspector::new(function ($name = null): void {})
    ->numberOfParameters(required: true);

echo $params; // `0`
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

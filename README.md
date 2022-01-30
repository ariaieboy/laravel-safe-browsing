# Google Safe Browsing API Integration for LARAVEL

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ariaieboy/laravel-safe-browsing.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/laravel-safe-browsing)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ariaieboy/laravel-safe-browsing/run-tests?label=tests)](https://github.com/ariaieboy/laravel-safe-browsing/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ariaieboy/laravel-safe-browsing/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ariaieboy/laravel-safe-browsing/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ariaieboy/laravel-safe-browsing.svg?style=flat-square)](https://packagist.org/packages/ariaieboy/laravel-safe-browsing)


---
Using this LaravelSafeBrowsing Package you can add google safe browsing api (v4) to your laravel application.

in applications that users generates the content of the website, It's necessary to check if the content is safe or not.

one of the important features of this package is that it will help you to check URLs and if it is not safe it will return the reason why it is not safe using [google safe browsing api v4](https://developers.google.com/safe-browsing/v4).

## Installation

You can install the package via composer:

```bash
composer require ariaieboy/laravel-safe-browsing
```

[//]: # (You can publish and run the migrations with:)

[//]: # ()
[//]: # (```bash)

[//]: # (php artisan vendor:publish --tag="laravel-safe-browsing_without_prefix-migrations")

[//]: # (php artisan migrate)

[//]: # (```)

You can publish the config file with:
```bash
php artisan vendor:publish --tag="laravel-safe-browsing"
```

This is the contents of the published config file:

```php
return [
    'google'=>[
        'api_key'=>env('SAFEBROWSING_GOOGLE_API_KEY',null),
        'timeout'=>30,
        'threatTypes' => [
            'THREAT_TYPE_UNSPECIFIED',
            'MALWARE',
            'SOCIAL_ENGINEERING',
            'UNWANTED_SOFTWARE',
            'POTENTIALLY_HARMFUL_APPLICATION',
        ],

        'threatPlatforms' => [
            'ANY_PLATFORM'
        ],
        'clientId' => 'ariaieboy-safebrowsing',
        'clientVersion' => '1.0.0',
    ]
];

Set the api_key in your config file or using ENV `SAFEBROWSING_GOOGLE_API_KEY`

```

## Usage

```php
    $result = LaravelSafeBrowsing::isSafeUrl('http://malware.testing.google.test/testing/malware/',true);
    // Return: (string) MALWARE
```
the first argument is the url that you want to check, the second argument is an optional boolean.
if you don't pass the second argument or pass false the function will return true if the url is safe or false if it is not safe.
if you pass true the function will return the threat type that is not safe. if the url is safe it will return true.


# TODO
- [ ] add middleware to check if the url is safe
- [ ] add verification rules to check if the url is safe
- [ ] add caching mechanism using update api


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

- [AriaieBOY](https://github.com/ariaieboy)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

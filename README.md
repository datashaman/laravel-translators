# laravel-translators

[![Latest Version on Packagist](https://img.shields.io/packagist/v/datashaman/laravel-translators.svg?style=flat-square)](https://packagist.org/packages/datashaman/laravel-translators)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/datashaman/laravel-translators/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/datashaman/laravel-translators/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/datashaman/laravel-translators/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/datashaman/laravel-translators/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/datashaman/laravel-translators.svg?style=flat-square)](https://packagist.org/packages/datashaman/laravel-translators)

Laravel manager for translators. WIP.

Includes drivers for:

- [Azure AI Translator](https://learn.microsoft.com/en-us/azure/ai-services/translator/)
- [DeepL](https://www.deepl.com/en/pro-api)
- [Google Translate](https://cloud.google.com/translate/docs/) - v2 and v3.
- [OpenAI](https://platform.openai.com/)

## Installation

The _OpenAI_ driver is the default, which can be changed easily.

You must still install the package with the driver you want to use:

```bash
composer require datashaman/laravel-translators openai-php/client // for OpenAI
composer require datashaman/laravel-translators google/cloud-translate // for Google Translate
composer require datashaman/laravel-translators deeplcom/deepl-php // for DeepL Translator
```

The _Azure AI Translator_ driver uses the REST API, so no additional packages are required:

```bash
composer require datashaman/laravel-translators
```

You can publish the config file if you wish to customize it in some way:

```bash
php artisan vendor:publish --tag="laravel-translators-config"
```

This is not necessary if you are using the default configuration.

## Usage

```php
use Datashaman\LaravelTranslators\Facades\Translator;

// Default is OpenAI
$translations = Translator::translate(['Hello, world!'], 'fr'); // ["Bonjour, monde !"]

$translations = Translator::driver('azure')->translate(['Hello, World!'], 'fr'); // ["Salut tout le monde!"]

$translations = Translator::driver('deepl')->translate(['Hello, World!'], 'fr'); // ["Bonjour à tous !"]

$translations = Translator::driver('google-v2')->translate(['Hello, World!'], 'fr'); // ["Bonjour le monde!"]

$translations = Translator::driver('google-v3')->translate(['Hello, World!'], 'fr'); // ["Bonjour le monde!"]
```


The default driver is _OpenAI_. You can change the default driver (set `TRANSLATOR_DRIVER` in your `.env` file).

There are various configuration requirements per service to setup before they can be used. There is an [example .env](.example.env) file with all the configuration options. You are also free to modify the config and environment variables (once config is published) to suit your own schema.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Datashaman](https://github.com/datashaman)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

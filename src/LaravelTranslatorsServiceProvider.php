<?php

namespace Datashaman\LaravelTranslators;

use DeepL\Translator;
use Google\Cloud\Translate\V2\TranslateClient;
use OpenAI;
use OpenAI\Client;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTranslatorsServiceProvider extends PackageServiceProvider
{
    public function register(): void
    {
        parent::register();

        if (! $this->app->bound(Client::class)) {
            $this->app->singleton(Client::class, fn () => OpenAI::client(config('translators.services.openai.api_key')));
        }

        $this->app->singleton(TranslateClient::class, fn () => new TranslateClient([
            'key' => config('translators.services.google-v2.key'),
        ]));

        $this->app->singleton(Translator::class, fn () => new Translator(config('translators.services.deepl.api_key')));
        $this->app->singleton('translator-manager', fn ($app) => new TranslatorManager($app));
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-translators')
            ->hasConfigFile();
    }
}

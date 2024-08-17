<?php

namespace Datashaman\LaravelTranslators;

use Datashaman\LaravelTranslators\Contracts\TranslatorInterface;
use Datashaman\LaravelTranslators\Translators\AzureTranslator;
use Datashaman\LaravelTranslators\Translators\DeepLTranslator;
use Datashaman\LaravelTranslators\Translators\GoogleV2Translator;
use Datashaman\LaravelTranslators\Translators\GoogleV3Translator;
use Datashaman\LaravelTranslators\Translators\OpenAITranslator;
use Illuminate\Support\Manager;

class TranslatorManager extends Manager
{
    public function getDefaultDriver()
    {
        return $this->config->get('translators.default');
    }

    public function createAzureDriver(): TranslatorInterface
    {
        return resolve(AzureTranslator::class);
    }

    public function createDeeplDriver(): TranslatorInterface
    {
        return resolve(DeepLTranslator::class);
    }

    public function createGoogleV2Driver(): TranslatorInterface
    {
        return resolve(GoogleV2Translator::class);
    }

    public function createGoogleV3Driver(): TranslatorInterface
    {
        return resolve(GoogleV3Translator::class);
    }

    public function createOpenaiDriver(): TranslatorInterface
    {
        return resolve(OpenAITranslator::class);
    }
}

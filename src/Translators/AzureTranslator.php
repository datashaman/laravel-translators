<?php

namespace Datashaman\LaravelTranslators\Translators;

use Datashaman\LaravelTranslators\Contracts\TranslatorInterface;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class AzureTranslator implements TranslatorInterface
{
    public function translate(
        array $contents,
        string $locale,
        array $options = []
    ): array {
        $client = Http::withQueryParameters(
            array_merge(
                [
                    'api-version' => '3.0',
                    'to' => $locale,
                ],
                $options
            )
        )->withHeaders([
            'Ocp-Apim-Subscription-Key' => config('translators.services.microsoft.key'),
            'Ocp-Apim-Subscription-Region' => config('translators.services.microsoft.region'),
        ]);

        $contents = array_map(
            fn ($content) => ['Text' => $content],
            $contents
        );

        $response = $client->post(
            'https://api.cognitive.microsofttranslator.com/translate',
            $contents
        )->throw()->json();

        return array_map(
            fn ($translation) => Arr::get($translation, 'translations.0.text'),
            $response
        );
    }
}

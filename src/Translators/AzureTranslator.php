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
            array_merge_recursive(
                config('translators.services.azure.options'),
                $options,
                [
                    'to' => $locale,
                ]
            )
        )->withHeaders([
            'Ocp-Apim-Subscription-Key' => config('translators.services.azure.key'),
            'Ocp-Apim-Subscription-Region' => config('translators.services.azure.region'),
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

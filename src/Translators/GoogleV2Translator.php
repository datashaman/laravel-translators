<?php

namespace Datashaman\LaravelTranslators\Translators;

use Datashaman\LaravelTranslators\Contracts\TranslatorInterface;

class GoogleV2Translator implements TranslatorInterface
{
    public function __construct(
        protected TranslateClient $client
    ) {}

    public function translate(
        array $contents,
        string $locale,
        array $options = []
    ): array {
        $translations = $this->client->translateBatch([
            'strings' => $contents,
            array_merge_recursive(
                config('translators.services.google-v2.options'),
                $options,
                [
                    'target' => $locale,
                ]
            ),
        ]);

        return array_map(
            fn ($translation) => $translation['text'],
            $translations
        );
    }
}

<?php

namespace Datashaman\LaravelTranslators\Translators;

use Datashaman\LaravelTranslators\Contracts\TranslatorInterface;
use Google\Cloud\Translate\V3\Client\TranslationServiceClient;
use Google\Cloud\Translate\V3\TranslateTextRequest;

class GoogleV3Translator implements TranslatorInterface
{
    public function __construct(
        protected TranslationServiceClient $client,
        protected TranslateTextRequest $request
    ) {}

    public function translate(
        array $contents,
        string $locale,
        array $options = []
    ): array {
        $parent = $this
            ->client
            ->locationName(config('translators.services.google-v3.project'), 'global');

        try {
            $request = $this
                ->request
                ->setContents($contents)
                ->setTargetLanguageCode($locale)
                ->setParent($parent);

            $response = $this
                ->client
                ->translateText(
                    $request,
                    array_merge_recursive(
                        config('translators.services.google-v3.options'),
                        $options
                    )
                );

            $translations = [];

            foreach ($response->getTranslations() as $translation) {
                $translations[] = $translation->getTranslatedText();
            }

            return $translations;
        } finally {
            $this->client->close();
        }
    }
}

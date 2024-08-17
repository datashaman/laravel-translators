<?php

namespace Datashaman\LaravelTranslators\Translators;

use Datashaman\LaravelTranslators\Contracts\TranslatorInterface;
use DeepL\Translator;

class DeepLTranslator implements TranslatorInterface
{
    public function __construct(
        protected Translator $translator
    ) {}

    public function translate(
        array $contents,
        string $locale,
        array $options = []
    ): array {
        $translations = $this->translator->translateText(
            $contents,
            sourceLang: null,
            targetLang: $locale,
            options: array_merge_recursive(
                config('translators.services.deepl.options'),
                $options,
            )
        );

        return array_map(
            fn ($translation) => $translation->text,
            $translations
        );
    }
}

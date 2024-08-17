<?php

namespace Datashaman\LaravelTranslators\Contracts;

interface TranslatorInterface
{
    public function translate(array $contents, string $locale, array $options = []): array;
}

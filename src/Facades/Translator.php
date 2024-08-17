<?php

namespace Datashaman\LaravelTranslators\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Datashaman\LaravelTranslators\TranslatorManager
 */
class Translator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'translator-manager';
    }
}

<?php

declare(strict_types=1);

namespace Folyod\Translator;

use Folyod\Translator\Exceptions\LanguageNotFoundException;
use Folyod\Translator\Exceptions\TranslateNotFoundException;

final class StaticTranslator
{
    private static LanguageTranslatorsCollector $languageTranslatorsCollector;

    private static string $currentLanguage;

    public static function initialize(string $currentLanguage, Translator $translator): void
    {
        self::$languageTranslatorsCollector = (new LanguageTranslatorsCollector())
            ->add($currentLanguage, $translator);
        self::$currentLanguage = $currentLanguage;
    }

    public static function addTranslator(string $language, Translator $translator): void
    {
        self::$languageTranslatorsCollector->add($language, $translator);
    }

    /**
     * @throws LanguageNotFoundException
     */
    public static function setCurrentLanguage(string $language): void
    {
        if (! self::$languageTranslatorsCollector->has($language)) {
            throw new LanguageNotFoundException($language);
        }
        self::$currentLanguage = $language;
    }

    /**
     * @throws LanguageNotFoundException
     * @throws TranslateNotFoundException
     */
    public static function translate(string $key): string
    {
        return self::$languageTranslatorsCollector->get(self::$currentLanguage)
            ->translate($key);
    }
}

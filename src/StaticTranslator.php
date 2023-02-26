<?php

declare(strict_types=1);

namespace Folyod\Translator;

use Folyod\Helpers\Exceptions\ServiceException;
use Folyod\Translator\Exceptions\LanguageNotFoundException;
use Folyod\Translator\Exceptions\TranslateNotFoundException;

final class StaticTranslator
{
    private static LanguageTranslatorsCollector $languageTranslatorsCollector;

    private static string $currentLanguage;

    /**
     * @param non-empty-string $currentLanguage
     */
    public static function initialize(string $currentLanguage, Translator $translator): void
    {
        self::$languageTranslatorsCollector = (new LanguageTranslatorsCollector())
            ->add($currentLanguage, $translator);
        self::$currentLanguage = $currentLanguage;
    }

    /**
     * @param non-empty-string $language
     */
    public static function addTranslator(string $language, Translator $translator): void
    {
        self::$languageTranslatorsCollector->add($language, $translator);
    }

    /**
     * @param  non-empty-string $language
     * @throws LanguageNotFoundException
     */
    public static function setCurrentLanguage(string $language): void
    {
        if (! self::$languageTranslatorsCollector->has($language)) {
            throw new LanguageNotFoundException($language);
        }
        self::$currentLanguage = $language;
    }

    public static function getCurrentLanguage(): ?string
    {
        return self::$currentLanguage ?? null;
    }

    /**
     * @param non-empty-string $key
     *
     * @throws ServiceException
     * @throws TranslateNotFoundException
     * @throws LanguageNotFoundException
     */
    public static function translate(string $key): string
    {
        return self::$languageTranslatorsCollector->get(self::$currentLanguage)
            ->translate($key);
    }
}

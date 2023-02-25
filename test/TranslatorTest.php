<?php

declare(strict_types=1);

namespace Test;

use Folyod\Translator\Exceptions\LanguageNotFoundException;
use Folyod\Translator\Exceptions\TranslateNotFoundException;
use Folyod\Translator\Providers\ArrayDataProvider;
use Folyod\Translator\StaticTranslator;
use Folyod\Translator\Translator;
use PHPUnit\Framework\TestCase;

final class TranslatorTest extends TestCase
{
    public function testTranslate(): void
    {
        $message = 'The value not a string. %type given';
        $translator = new Translator(new ArrayDataProvider([
            'not_a_string' => $message
        ]));
        StaticTranslator::initialize('eng_tech', $translator);
        $actual = StaticTranslator::translate('not_a_string');
        $this->assertSame($message, $actual);
    }

    public function testLanguageNotFound(): void
    {
        $this->expectException(LanguageNotFoundException::class);
        $this->expectExceptionMessage('language somelang not found');

        $message = 'The value not a string. %type given';
        $translator = new Translator(new ArrayDataProvider([
            'not_a_string' => $message
        ]));
        StaticTranslator::initialize('eng_tech', $translator);
        StaticTranslator::setCurrentLanguage('somelang');
    }

    public function testKeyNotFound(): void
    {
        $this->expectException(TranslateNotFoundException::class);
        $this->expectExceptionMessage('translate for key wrongkey not found');

        $message = 'The value not a string. %type given';
        $translator = new Translator(new ArrayDataProvider([
            'not_a_string' => $message
        ]));
        StaticTranslator::initialize('eng_tech', $translator);
        StaticTranslator::translate('wrongkey');
    }
}

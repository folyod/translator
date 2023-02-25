<?php

declare(strict_types=1);

namespace Folyod\Translator;

use Folyod\Translator\Exceptions\TranslateNotFoundException;
use Folyod\Translator\Providers\DataProvider;

final readonly class Translator
{
    public function __construct(
        private DataProvider $dataProvider,
    ) {
    }

    /**
     * @throws TranslateNotFoundException
     */
    public function translate(string $key): string
    {
        $translate = $this->dataProvider->get($key);
        if (! $translate) {
            throw new TranslateNotFoundException($key);
        }

        return $translate;
    }
}

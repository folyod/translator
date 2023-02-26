<?php

declare(strict_types=1);

namespace Folyod\Translator;

use Folyod\Helpers\Exceptions\ServiceException;
use Folyod\Helpers\Str;
use Folyod\Translator\Exceptions\TranslateNotFoundException;
use Folyod\Translator\Providers\DataProvider;
use Stringable;

final readonly class Translator
{
    public function __construct(
        private DataProvider $dataProvider,
    ) {
    }

    /**
     * @param non-empty-string                     $key
     * @param array<string, string|Stringable|int> $context
     *
     * @throws TranslateNotFoundException
     * @throws ServiceException
     */
    public function translate(string $key, array $context = []): string
    {
        $translate = $this->dataProvider->get($key);
        if (! $translate) {
            throw new TranslateNotFoundException($key);
        }
        $translate = Str::replaceAll($translate, $context);

        return $translate;
    }
}

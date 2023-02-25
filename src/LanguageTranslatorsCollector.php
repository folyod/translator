<?php

declare(strict_types=1);

namespace Folyod\Translator;

use Folyod\Translator\Exceptions\LanguageNotFoundException;

final class LanguageTranslatorsCollector
{
    /**
     * @var Translator[]
     */
    private array $map = [];

    public function add(string $language, Translator $translator): self
    {
        $this->map[$language] = $translator;

        return $this;
    }

    /**
     * @throws LanguageNotFoundException
     */
    public function get(string $language): Translator
    {
        if (! $this->has($language)) {
            throw new LanguageNotFoundException($language);
        }
        return $this->map[$language];
    }

    public function has(string $language): bool
    {
        return isset($this->map[$language]);
    }
}

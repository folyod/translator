<?php

declare(strict_types=1);

namespace Folyod\Translator\Providers;

use Folyod\Helpers\UnsafeArr;
use InvalidArgumentException;

final class ArrayDataProvider implements DataProvider
{
    /**
     * @param array<string, mixed> $translates
     */
    public function __construct(
        private array $translates,
    ) {
    }

    /**
     * @param non-empty-string $key
     */
    public function get(string $key): ?string
    {
        $translation = UnsafeArr::get($this->translates, $key);
        if (! is_string($translation) && ! is_null($translation)) {
            throw new InvalidArgumentException("The value is not a string");
        }

        return $translation;
    }

    /**
     * @param non-empty-string $key
     */
    public function has(string $key): bool
    {
        return UnsafeArr::has($this->translates, $key);
    }
}

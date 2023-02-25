<?php

declare(strict_types=1);

namespace Folyod\Translator\Providers;

use Folyod\Helpers\UnsafeArr;

final class ArrayDataProvider implements DataProvider
{
    public function __construct(
        private array $translates,
    ) {
    }

    public function get(string $key): ?string
    {
        return UnsafeArr::get($this->translates, $key);
    }

    public function has(string $key): bool
    {
        return UnsafeArr::has($this->translates, $key);
    }
}

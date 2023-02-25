<?php

declare(strict_types=1);

namespace Folyod\Translator\Providers;

interface DataProvider
{
    public function get(string $key): ?string;

    public function has(string $key): bool;
}

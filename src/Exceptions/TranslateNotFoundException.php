<?php

declare(strict_types=1);

namespace Folyod\Translator\Exceptions;

use Exception;

final class TranslateNotFoundException extends Exception
{
    public function __construct(string $key)
    {
        $message = sprintf(
            "translate for key %s not found",
            $key,
        );

        parent::__construct($message);
    }
}

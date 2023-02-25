<?php

declare(strict_types=1);

namespace Folyod\Translator\Exceptions;

use Exception;

final class LanguageNotFoundException extends Exception
{
    public function __construct(string $language)
    {
        $message = sprintf(
            "language %s not found",
            $language,
        );

        parent::__construct($message);
    }
}

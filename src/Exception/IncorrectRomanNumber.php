<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Throwable;

final class IncorrectRomanNumber extends Exception
{
    private function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function containProhibitedChar() : self
    {
        return new self('Roman value contains incorrect char');
    }
}

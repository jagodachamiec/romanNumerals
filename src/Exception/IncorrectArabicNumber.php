<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Throwable;

final class IncorrectArabicNumber extends Exception
{
    private function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function zeroOrLower() : self
    {
        return new self('Arabic number must be bigger than zero');
    }
}

<?php

declare(strict_types=1);

namespace App\RomanDigit;

final class Five implements RomanDigit
{
    public function getStringRepresentation() : string
    {
        return 'V';
    }

    public function getValue() : int
    {
        return 5;
    }
}

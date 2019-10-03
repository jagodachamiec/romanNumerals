<?php

declare(strict_types=1);

namespace App\RomanDigit;

final class One implements RomanDigit
{
    public function getStringRepresentation() : string
    {
        return 'I';
    }

    public function getValue() : int
    {
        return 1;
    }
}

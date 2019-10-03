<?php

declare(strict_types=1);

namespace App\RomanDigit;

final class Thousand implements RomanDigit
{
    public function getStringRepresentation() : string
    {
        return 'M';
    }

    public function getValue() : int
    {
        return 1000;
    }
}

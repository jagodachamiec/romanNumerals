<?php

declare(strict_types=1);

namespace App\RomanDigit;

final class Fifty implements RomanDigit
{
    public function getStringRepresentation() : string
    {
        return 'L';
    }

    public function getValue() : int
    {
        return 50;
    }
}

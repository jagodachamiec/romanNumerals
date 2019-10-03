<?php

declare(strict_types=1);

namespace App\RomanDigit;

final class Hundred implements RomanDigit
{
    public function getStringRepresentation() : string
    {
        return 'C';
    }

    public function getValue() : int
    {
        return 100;
    }
}

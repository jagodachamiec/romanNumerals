<?php

declare(strict_types=1);

namespace App\RomanDigit;

final class FiveHundred implements RomanDigit
{
    public function getStringRepresentation() : string
    {
        return 'D';
    }

    public function getValue() : int
    {
        return 500;
    }
}

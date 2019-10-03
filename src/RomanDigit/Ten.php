<?php

declare(strict_types=1);

namespace App\RomanDigit;

final class Ten implements RomanDigit
{
    public function getStringRepresentation() : string
    {
        return 'X';
    }

    public function getValue() : int
    {
        return 10;
    }
}

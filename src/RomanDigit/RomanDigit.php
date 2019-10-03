<?php

declare(strict_types=1);

namespace App\RomanDigit;

interface RomanDigit
{
    public function getStringRepresentation() : string;

    public function getValue() : int;
}

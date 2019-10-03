<?php

declare(strict_types=1);

namespace App;

use App\Exception\IncorrectRomanNumber;
use Ds\Map;
use function str_split;
use function substr;

final class RomanToArabicConverter
{
    /** @var int */
    private $arabicNumber;

    /** @var Map<string, int> */
    private $mapper;
    /** @var string */
    private $romanNumber;

    public function __construct()
    {
        $this->mapper = new Map([
            'I' => 1,
            'V' => 5,
            'X' => 10,
            'L' => 50,
            'C' => 100,
            'D' => 500,
            'M' => 1000,
        ]);
    }

    /**
     * @throws IncorrectRomanNumber
     */
    public function convertRomanToArabic(string $romanNumber) : int
    {
        if (! $this->isRomanNumberCorrect($romanNumber)) {
            throw IncorrectRomanNumber::containProhibitedChar();
        }

        $this->arabicNumber = 0;
        $this->romanNumber  = $romanNumber;

        while (! empty($this->romanNumber)) {
            $lastChar = $this->popLastChar();
            $this->addNumber($lastChar);

            if (! $this->shouldPreviousCharBeSubtracted($lastChar)) {
                continue;
            }

            $this->subtractPreviousChar();
        }

        return $this->arabicNumber;
    }

    private function shouldPreviousCharBeSubtracted(string $lastChar) : bool
    {
        $previousChar = substr($this->romanNumber, -1);

        return ! empty($this->romanNumber) && $this->mapper[$lastChar] > $this->mapper[$previousChar];
    }

    private function addNumber(string $char) : void
    {
        $this->arabicNumber += $this->mapper[$char];
    }

    private function subtractPreviousChar() : void
    {
        $lastChar            = $this->popLastChar();
        $this->arabicNumber -= $this->mapper[$lastChar];
    }

    private function isRomanNumberCorrect(string $romanNumber) : bool
    {
        $allChars = str_split($romanNumber);

        foreach ($allChars as $char) {
            if (! $this->mapper->hasKey($char)) {
                return false;
            }
        }

        return true;
    }

    private function popLastChar() : string
    {
        $lastChar          = substr($this->romanNumber, -1);
        $this->romanNumber = substr($this->romanNumber, 0, -1);

        return $lastChar;
    }
}

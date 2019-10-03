<?php

declare(strict_types=1);

namespace App;

use App\Exception\IncorrectArabicNumber;
use App\RomanDigit\Fifty;
use App\RomanDigit\Five;
use App\RomanDigit\FiveHundred;
use App\RomanDigit\Hundred;
use App\RomanDigit\One;
use App\RomanDigit\RomanDigit;
use App\RomanDigit\Ten;
use App\RomanDigit\Thousand;

final class ArabicToRomanConverter
{
    /** @var string */
    private $romanNumber;

    /** @var int */
    private $arabicNumber;

    /**
     * @throws IncorrectArabicNumber
     */
    public function convertArabicToRomanNumber(int $arabicNumber) : string
    {
        $this->validateArabicNumber($arabicNumber);

        $this->romanNumber  = '';
        $this->arabicNumber = $arabicNumber;

        $this->handleNumber(new Thousand(), new Hundred());
        $this->handleNumber(new FiveHundred(), new Hundred());
        $this->handleNumber(new Hundred(), new Ten());
        $this->handleNumber(new Fifty(), new Ten());
        $this->handleNumber(new Ten(), new One());
        $this->handleNumber(new Five(), new One());
        $this->handleNumber(new One(), null);

        return $this->romanNumber;
    }

    private function handleNumber(RomanDigit $romanDigit, ?RomanDigit $subtractionRomanDigit) : void
    {
        $valueOfRomanDigit = $romanDigit->getValue();

        $this->handleSubtraction($romanDigit, $subtractionRomanDigit);

        while ($this->isArabicNumberBiggerThanHandleNumber($valueOfRomanDigit)) {
            $this->concatRomanNumber($romanDigit);
            $this->subtractValueOfRomanDigit($valueOfRomanDigit);

            $this->handleSubtraction($romanDigit, $subtractionRomanDigit);
        }
    }

    private function handleSubtraction(RomanDigit $romanDigit, ?RomanDigit $subtractionRomanDigit) : void
    {
        if ($subtractionRomanDigit === null) {
            return;
        }

        if ($this->arabicNumber <= 0) {
            return;
        }

        $valueOfRomanSubtractionDigit = $subtractionRomanDigit->getValue();
        $valueOfRomanDigit            = $romanDigit->getValue();

        if ($this->isBeyondRangeOfHandleNumberAndSubtractionNumber($valueOfRomanDigit, $valueOfRomanSubtractionDigit)) {
            return;
        }

        $this->concatRomanNumber($subtractionRomanDigit);
        $this->addValueOfRomanDigit($valueOfRomanSubtractionDigit);
    }

    /**
     * @throws IncorrectArabicNumber
     */
    private function validateArabicNumber(int $arabicNumber) : void
    {
        if ($arabicNumber <= 0) {
            throw IncorrectArabicNumber::zeroOrLower();
        }
    }

    private function concatRomanNumber(RomanDigit $romanDigit) : void
    {
        $this->romanNumber .= $romanDigit->getStringRepresentation();
    }

    private function subtractValueOfRomanDigit(int $valueOfRomanDigit) : void
    {
        $this->arabicNumber -= $valueOfRomanDigit;
    }

    private function addValueOfRomanDigit(int $valueOfRomanSubtractionDigit) : void
    {
        $this->arabicNumber += $valueOfRomanSubtractionDigit;
    }

    private function isArabicNumberBiggerThanHandleNumber(int $valueOfRomanDigit) : bool
    {
        return $this->arabicNumber >= $valueOfRomanDigit;
    }

    private function isBeyondRangeOfHandleNumberAndSubtractionNumber(int $valueOfRomanDigit, int $valueOfRomanSubtractionDigit) : bool
    {
        return $this->arabicNumber < $valueOfRomanDigit - $valueOfRomanSubtractionDigit ||
            $this->isArabicNumberBiggerThanHandleNumber($valueOfRomanDigit);
    }
}

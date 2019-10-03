<?php

declare(strict_types=1);

namespace App\Tests;

use App\Exception\IncorrectRomanNumber;
use App\RomanToArabicConverter;
use PHPUnit\Framework\TestCase;

class RomanToArabicConverterTest extends TestCase
{
    /** @var RomanToArabicConverter */
    private $converter;

    /**
     * @return mixed[]
     */
    public function provider() : array
    {
        return [
            [1, 'I'],
            [2, 'II'],
            [3, 'III'],
            [5, 'V'],
            [10, 'X'],
            [50, 'L'],
            [100, 'C'],
            [500, 'D'],
            [1000, 'M'],
            [6, 'VI'],
            [12, 'XII'],
            [316, 'CCCXVI'],
            [2333, 'MMCCCXXXIII'],
            [4, 'IV'],
            [9, 'IX'],
            [40, 'XL'],
            [90, 'XC'],
            [400, 'CD'],
            [900, 'CM'],
            [1984, 'MCMLXXXIV'],
            [2999, 'MMCMXCIX'],
        ];
    }

    /**
     * @dataProvider provider
     */
    public function testConvertRomanToArabic(int $expected, string $argument) : void
    {
        $this->assertEquals($expected, $this->converter->convertRomanToArabic($argument));
    }

    public function testConvertRomanToArabicIncorrectNumber() : void
    {
        $this->expectException(IncorrectRomanNumber::class);

        $this->converter->convertRomanToArabic('MRD');
    }

    public function setUp() : void
    {
        $this->converter = new RomanToArabicConverter();
    }
}

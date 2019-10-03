<?php

declare(strict_types=1);

namespace App\Tests;

use App\ArabicToRomanConverter;
use App\Exception\IncorrectArabicNumber;
use PHPUnit\Framework\TestCase;

class ArabicToRomanConverterTest extends TestCase
{
    /** @var ArabicToRomanConverter */
    private $converter;

    /**
     * @return mixed[]
     */
    public function provider() : array
    {
        return [
            ['I', 1],
            ['II', 2],
            ['III', 3],
            ['V', 5],
            ['VI', 6],
            ['X', 10],
            ['XVIII', 18],
            ['L', 50],
            ['LXXXVIII', 88],
            ['C', 100],
            ['D', 500],
            ['M', 1000],
            ['MMM', 3000],
            ['IV', 4],
            ['IX', 9],
            ['XL', 40],
            ['XC', 90],
            ['CD', 400],
            ['CM', 900],
            ['MCMLXXXIV', 1984],
            ['MMCMXCIX', 2999],
        ];
    }

    /**
     * @dataProvider provider
     */
    public function testConvertArabicToRomanNumber(string $expected, int $argument) : void
    {
        $this->assertEquals($expected, $this->converter->convertArabicToRomanNumber($argument));
    }

    public function testConvertZeroToRomanNumber() : void
    {
        $this->expectException(IncorrectArabicNumber::class);

        $this->converter->convertArabicToRomanNumber(0);
    }

    public function testConvertNegativeNumberToRomanNumber() : void
    {
        $this->expectException(IncorrectArabicNumber::class);

        $this->converter->convertArabicToRomanNumber(-1);
    }

    public function setUp() : void
    {
        $this->converter = new ArabicToRomanConverter();
    }
}

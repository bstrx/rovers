<?php

namespace Tests\Entity;

use App\Entity\Plateau;
use App\Entity\Position;
use PHPUnit\Framework\TestCase;

final class PlateauTest extends TestCase
{
    /**
     * @dataProvider isValidPositionProvider
     *
     * @param int $width
     * @param int $length
     * @param int $x
     * @param int $y
     * @param bool $expectedResult
     */
    public function testIsValidPosition(int $width, int $length, int $x, int $y, bool $expectedResult): void
    {
        $plateau = new Plateau($width, $length);
        $position = new Position($x, $y, 'N');

        $result = $plateau->isValidPosition($position);

        $this->assertEquals($expectedResult, $result);
    }

    public function isValidPositionProvider()
    {
        return [
            [
                'width' => 1,
                'height' => 1,
                'x' => 0,
                'y' => 0,
                'result' => true
            ],
            [
                'width' => 1,
                'height' => 1,
                'x' => 1,
                'y' => 1,
                'result' => false
            ],
            [
                'width' => 5,
                'height' => 1,
                'x' => 5,
                'y' => 1,
                'result' => false
            ],
            [
                'width' => 1,
                'height' => 5,
                'x' => 1,
                'y' => 4,
                'result' => true
            ],
        ];
    }
}

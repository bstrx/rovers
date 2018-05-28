<?php

namespace App\Entity;

final class Plateau
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $length;

    /**
     * @param int $width
     * @param int $length
     */
    public function __construct(int $width, int $length)
    {
        $this->width = $width;
        $this->length = $length;
    }

    /**
     * Checks if a given position is in plateau's border
     *
     * @param Position $position
     * @return bool
     */
    public function isValidPosition(Position $position): bool
    {
        return $position->getX() >= 0 &&
            $position->getX() <= $this->width &&
            $position->getY() >= 0 &&
            $position->getY() <= $this->length;
    }
}

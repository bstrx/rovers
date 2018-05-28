<?php

namespace App\Entity;

final class Position
{
    public const DIRECTION_NORTH = 'N';
    public const DIRECTION_WEST = 'W';
    public const DIRECTION_SOUTH = 'S';
    public const DIRECTION_EAST = 'E';

    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @var string
     */
    private $direction;

    /**
     * @param int $x
     * @param int $y
     * @param string $direction
     */
    public function __construct(int $x, int $y, string $direction)
    {
        $this->x = $x;
        $this->y = $y;
        $this->direction = $direction;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }
}

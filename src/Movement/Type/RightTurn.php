<?php

namespace App\Movement\Type;

use App\Entity\Position;

final class RightTurn implements MovementInterface
{
    private const DIRECTION_CHANGES = [
        Position::DIRECTION_NORTH => Position::DIRECTION_EAST,
        Position::DIRECTION_EAST => Position::DIRECTION_SOUTH,
        Position::DIRECTION_SOUTH => Position::DIRECTION_WEST,
        Position::DIRECTION_WEST => Position::DIRECTION_NORTH
    ];

    /**
     * @param Position $position
     * @return Position
     */
    public function getNextPosition(Position $position): Position
    {
        return new Position(
            $position->getX(),
            $position->getY(),
            self::DIRECTION_CHANGES[$position->getDirection()]
        );
    }


}

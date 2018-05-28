<?php

namespace App\Movement\Type;

use App\Entity\Position;

final class StepForward implements MovementInterface
{
    /**
     * @param Position $position
     * @return Position
     */
    public function getNextPosition(Position $position): Position
    {
        $x = $position->getX();
        $y = $position->getY();

        switch ($position->getDirection()) {
            case Position::DIRECTION_NORTH:
                $y++;
                break;
            case Position::DIRECTION_WEST:
                $x--;
                break;
            case Position::DIRECTION_EAST:
                $x++;
                break;
            case Position::DIRECTION_SOUTH:
                $y--;
        }

        return new Position(
            $x,
            $y,
            $position->getDirection()
        );
    }
}

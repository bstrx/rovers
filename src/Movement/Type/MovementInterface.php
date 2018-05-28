<?php

namespace App\Movement\Type;


use App\Entity\Position;

interface MovementInterface
{
    /**
     * Returns a new position after applying movement to a given position
     *
     * @param Position $position
     * @return Position
     */
    public function getNextPosition(Position $position): Position;
}

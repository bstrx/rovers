<?php

namespace App\Movement;

use InvalidArgumentException;
use App\Movement\Type\LeftTurn;
use App\Movement\Type\MovementInterface;
use App\Movement\Type\RightTurn;
use App\Movement\Type\StepForward;

final class MovementFactory
{
    private const TYPE_TO_CLASS = [
        'L' => LeftTurn::class,
        'R' => RightTurn::class,
        'M' => StepForward::class
    ];

    /**
     * @param string $type
     * @return MovementInterface
     * @throws InvalidArgumentException
     */
    public function createMovement(string $type): MovementInterface
    {
        if (!array_key_exists($type, self::TYPE_TO_CLASS)) {
            throw new InvalidArgumentException();
        }

        $movementClass = self::TYPE_TO_CLASS[$type];

        return new $movementClass();
    }
}

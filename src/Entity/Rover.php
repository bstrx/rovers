<?php

namespace App\Entity;

use Exception;
use App\Collection\MovementCollection;
use App\Movement\Type\MovementInterface;

final class Rover
{
    /**
     * @var Position
     */
    private $position;

    /**
     * @var MovementCollection
     */
    private $movements;

    /**
     * @var Plateau
     */
    private $plateau;

    /**
     * @param Position $position
     * @param MovementCollection $movements
     * @param Plateau $plateau
     */
    public function __construct(Position $position, MovementCollection $movements, Plateau $plateau)
    {
        $this->position = $position;
        $this->movements = $movements;
        $this->plateau = $plateau;
    }

    /**
     * @return Position
     */
    public function getPosition(): Position
    {
        return $this->position;
    }

    /**
     * @throws Exception
     */
    public function makeMoves(): void
    {
        /** @var MovementInterface $movement */
        foreach ($this->movements as $movement) {
            $this->position = $this->getNextPosition($this->position, $movement);
            $this->movements->removeElement($movement);
        }
    }

    /**
     * @param Position $position
     * @param MovementInterface $movement
     * @return Position
     * @throws Exception
     */
    private function getNextPosition(Position $position, MovementInterface $movement)
    {
        $nextPosition = $movement->getNextPosition($position);

        if (!$this->plateau->isValidPosition($nextPosition)) {
            throw new Exception();
        }

        return $nextPosition;
    }
}

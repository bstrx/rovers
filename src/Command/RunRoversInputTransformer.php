<?php

namespace App\Command;

use App\Collection\MovementCollection;
use App\Collection\RoverCollection;
use App\Entity\Plateau;
use App\Entity\Position;
use App\Entity\Rover;
use App\Movement\MovementFactory;

/**
 * Incapsulates a dirty job of transforming a raw command input into pretty entities.
 */
final class RunRoversInputTransformer
{
    /**
     * @var string
     */
    private $commandInput;

    /**
     * @param string $commandInput
     */
    public function __construct(string $commandInput)
    {
        $this->commandInput = $commandInput;
    }

    /**
     * @return RoverCollection
     */
    public function getRoversFromInput(): RoverCollection
    {
        $inputLines = explode(PHP_EOL, $this->commandInput);
        $inputLines = $this->cleanData($inputLines);

        return $this->getRovers($inputLines);
    }

    /**
     * @param array $simulationInfo
     * @return RoverCollection
     */
    private function getRovers(array $simulationInfo): RoverCollection
    {
        $rovers = new RoverCollection();
        $plateau = $this->getPlateau(array_shift($simulationInfo));

        while (!empty($simulationInfo)) {
            $position = $this->getPosition(array_shift($simulationInfo));
            $movements = $this->getMovements(array_shift($simulationInfo));

            $rovers->add(new Rover($position, $movements, $plateau));
        }

        return $rovers;
    }

    /**
     * @param array $inputLines
     * @return array
     */
    private function cleanData(array $inputLines): array
    {
        return array_map(function ($command) {
            return trim($command);
        }, $inputLines);
    }

    /**
     * @param string $plateauData
     * @return Plateau
     */
    private function getPlateau(string $plateauData): Plateau
    {
        $plateau = explode(' ', $plateauData);

        return new Plateau($plateau[0], $plateau[1]);
    }

    /**
     * @param string $positionData
     * @return Position
     */
    private function getPosition(string $positionData): Position
    {
        $position = explode(' ', $positionData);

        return new Position($position[0], $position[1], $position[2]);
    }

    /**
     * @param string $movementsData
     * @return MovementCollection
     */
    private function getMovements(string $movementsData): MovementCollection
    {
        $movementsFactory = new MovementFactory();
        $movements = new MovementCollection();

        foreach (str_split($movementsData) as $movementType) {
            $movement = $movementsFactory->createMovement($movementType);
            $movements->add($movement);
        }

        return $movements;
    }
}

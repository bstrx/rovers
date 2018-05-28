<?php

namespace Tests\Movement;

use InvalidArgumentException;
use App\Movement\MovementFactory;
use App\Movement\Type\LeftTurn;
use PHPUnit\Framework\TestCase;

final class MovementFactoryTest extends TestCase
{
    /**
     * @var MovementFactory
     */
    private $movementFactory;

    public function testCreateMovement(): void
    {
        $movement = $this->movementFactory->createMovement('L');

        $this->assertEquals(LeftTurn::class, get_class($movement));
    }

    public function testCreateMovementFailure(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->movementFactory->createMovement('INVALID_TYPE');
    }

    protected function setUp(): void
    {
        $this->movementFactory = new MovementFactory();
    }
}

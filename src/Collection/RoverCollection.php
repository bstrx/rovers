<?php

namespace App\Collection;

use ArrayIterator;
use App\Entity\Rover;
use IteratorAggregate;

final class RoverCollection implements IteratorAggregate
{
    /**
     * @var Rover[]
     */
    private $elements;

    /**
     * @param Rover $element
     */
    public function add(Rover $element)
    {
        $this->elements[] = $element;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new ArrayIterator($this->elements);
    }
}

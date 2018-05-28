<?php

namespace App\Collection;

use IteratorAggregate;
use ArrayIterator;
use App\Movement\Type\MovementInterface;

final class MovementCollection implements IteratorAggregate
{
    /**
     * @var MovementInterface[]
     */
    private $elements;

    /**
     * @param MovementInterface $element
     */
    public function add(MovementInterface $element)
    {
        $this->elements[] = $element;
    }

    /**
     * @param MovementInterface $element
     * @return bool
     */
    public function removeElement(MovementInterface $element)
    {
        $key = array_search($element, $this->elements, true);

        if ($key === false) {
            return false;
        }

        unset($this->elements[$key]);

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new ArrayIterator($this->elements);
    }
}

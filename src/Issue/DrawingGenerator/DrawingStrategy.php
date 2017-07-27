<?php

namespace GyTreasure\Issue\DrawingGenerator;

abstract class DrawingStrategy
{
    /**
     * @return array
     */
    abstract public function generate();

    /**
     * 豹子號.
     *
     * @param  array  $numbers
     * @return bool
     */
    protected function numbersInARow(array $numbers)
    {
        return count(array_unique($numbers)) === 1;
    }
}

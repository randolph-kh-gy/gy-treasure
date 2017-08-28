<?php

namespace GyTreasure\Issue\DrawingGenerator;

abstract class DrawingStrategy
{
    /**
     * @return array
     */
    abstract public function generate();

    /**
     * @param  int  $min
     * @param  int  $max
     * @return int
     */
    public function randomInt($min, $max)
    {
        return random_int($min, $max);
    }

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

<?php

namespace GyTreasure\Issue\DrawingGenerator\Strategies;

use GyTreasure\Issue\DrawingGenerator\DrawingStrategy;
use GyTreasure\Support\Randomizer;

class TakeThreeStrategy extends DrawingStrategy
{
    /**
     * @return array
     */
    public function generate()
    {
        do {
            $numbers = $this->generateNumbers();
        } while($this->needsRegenerate($numbers));
        return $numbers;
    }

    /**
     * @param  array  $numbers
     * @return bool
     */
    protected function needsRegenerate(array $numbers)
    {
        if ($this->numbersInARow($numbers)) {
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    protected function generateNumbers()
    {
        return str_split(sprintf('%03d', Randomizer::randomInt(0, 999)));
    }
}

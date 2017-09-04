<?php

namespace GyTreasure\Issue\DrawingGenerator\Strategies;

use GyTreasure\Issue\DrawingGenerator\DrawingStrategy;
use GyTreasure\Support\Randomizer;

class ShuffleTenStrategy extends DrawingStrategy
{
    /**
     * @return array
     */
    public function generate()
    {
        return Randomizer::shuffle($this->rangeNumbers());
    }

    /**
     * @return array
     */
    protected function rangeNumbers()
    {
        return array_map('strval', range(1, 10));
    }
}

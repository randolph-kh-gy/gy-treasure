<?php

namespace GyTreasure\Issue\DrawingGenerator\Strategies;

use GyTreasure\Issue\DrawingGenerator\DrawingStrategy;

class TakeThreeStrategy extends DrawingStrategy
{
    /**
     * @return \RandomLib\Generator
     */
    protected function generator()
    {
        $factory = new \RandomLib\Factory;
        $generator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::HIGH));
        return $generator;
    }

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
        return str_split(sprintf('%03d', $this->generator()->generateInt(0, 999)));
    }
}
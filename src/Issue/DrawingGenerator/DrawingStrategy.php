<?php

namespace GyTreasure\Issue\DrawingGenerator;

abstract class DrawingStrategy
{
    /**
     * @var \RandomLib\Generator
     */
    protected static $randomLibGenerator;

    /**
     * @return \RandomLib\Generator
     */
    protected static function getRandomLibGenerator()
    {
        if (static::$randomLibGenerator === null) {
            $factory = new \RandomLib\Factory;
            static::$randomLibGenerator = $factory->getGenerator(new \SecurityLib\Strength(\SecurityLib\Strength::HIGH));
        }

        return static::$randomLibGenerator;
    }

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
        return static::getRandomLibGenerator()->generateInt($min, $max);
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

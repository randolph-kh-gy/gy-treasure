<?php

namespace GyTreasure\Issue\DrawingGenerator;

use GyTreasure\Issue\DrawingGenerator\Strategies\TakeFiveStrategy;

class DrawingStrategyFactory
{
    /**
     * @param  string  $id
     * @return \GyTreasure\Issue\DrawingGenerator\DrawingStrategy
     */
    public static function make($id)
    {
        switch ($id)
        {
            default:
                return new TakeFiveStrategy();
        }
    }
}

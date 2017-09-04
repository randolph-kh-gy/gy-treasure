<?php

namespace GyTreasure\Issue\DrawingGenerator;

use GyTreasure\Issue\DrawingGenerator\Strategies\ElevenFiveStrategy;
use GyTreasure\Issue\DrawingGenerator\Strategies\ShuffleTenStrategy;
use GyTreasure\Issue\DrawingGenerator\Strategies\TakeFiveStrategy;

class DrawingStrategyFactory
{
    /**
     * @param  string  $id
     * @return \GyTreasure\Issue\DrawingGenerator\DrawingStrategy
     */
    public static function make($id)
    {
        switch ($id) {
            case 'yifen115':
                // no break
            case 'liangfen115':
                // no break
            case 'wufen115':
                return new ElevenFiveStrategy();
            case 'pk10':
                return new ShuffleTenStrategy();
            default:
                return new TakeFiveStrategy();
        }
    }
}

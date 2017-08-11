<?php

namespace GyTreasure\Issue\DrawingGenerator;

use GyTreasure\Issue\DrawingGenerator\Strategies\ElevenFiveStrategy;
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
            default:
                return new TakeFiveStrategy();
        }
    }
}

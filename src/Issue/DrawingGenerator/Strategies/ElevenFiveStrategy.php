<?php

namespace GyTreasure\Issue\DrawingGenerator\Strategies;

use GyTreasure\Issue\DrawingGenerator\DrawingStrategy;
use GyTreasure\Support\Randomizer;

class ElevenFiveStrategy extends DrawingStrategy
{
    /**
     * 抓五个号码.
     */
    const DRAW_NUM = 5;

    /**
     * @return array
     */
    public function generate()
    {
        $array = Randomizer::shuffle($this->_rangeNumbers());
        return array_splice($array, 0, static::DRAW_NUM);
    }

    /**
     * 产生 01-11 的阵列.
     *
     * @return array
     */
    private function _rangeNumbers()
    {
        return [
            '01', '02', '03', '04', '05', '06',
            '07', '08', '09', '10', '11'
        ];
    }
}

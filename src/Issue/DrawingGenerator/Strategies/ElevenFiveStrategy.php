<?php

namespace GyTreasure\Issue\DrawingGenerator\Strategies;

use GyTreasure\Issue\DrawingGenerator\DrawingStrategy;

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
        return $this->shuffle($this->_rangeNumbers(), self::DRAW_NUM);
    }

    /**
     * shuffle 阵列.
     * 因使用安全乱数函式避免被猜测, 所以不使用原生 shuffle 函式实现.
     *
     * @param  array  $array
     * @param  int    $length
     * @return array
     */
    protected function shuffle(array $array, $length)
    {
        $returnArray = [];
        for ($i = 0; $i < $length; $i++) {
            $index = $this->randomInt(0, count($array) - 1);
            $returnArray[] = array_splice($array, $index, 1);
        }

        return call_user_func_array('array_merge', $returnArray);
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

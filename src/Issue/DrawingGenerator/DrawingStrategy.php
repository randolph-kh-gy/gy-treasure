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

    /**
     * shuffle 阵列.
     * 因使用安全乱数函式避免被猜测, 所以不使用原生 shuffle 函式实现.
     *
     * @param  array  $array
     * @return array
     */
    protected function shuffle(array $array)
    {
        for ($i = 0, $len = count($array); $i < $len; $i++) {
            $index = $this->randomInt($i, $len - 1);
            list($array[$i], $array[$index]) = [$array[$index], $array[$i]];
        }

        return $array;
    }
}

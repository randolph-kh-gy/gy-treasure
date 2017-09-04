<?php

namespace GyTreasure\Support;

class Randomizer
{
    /**
     * @param  int  $min
     * @param  int  $max
     * @return int
     */
    public static function randomInt($min, $max)
    {
        try {
            return random_int($min, $max);
        } catch (\Exception $e) {
            return mt_rand($min, $max);
        }
    }

    /**
     * shuffle 阵列.
     * 因使用安全乱数函式避免被猜测, 所以不使用原生 shuffle 函式实现.
     *
     * @param  array  $array
     * @return array
     */
    public static function shuffle(array $array)
    {
        for ($i = 0, $len = count($array); $i < $len; $i++) {
            $index = static::randomInt($i, $len - 1);
            list($array[$i], $array[$index]) = [$array[$index], $array[$i]];
        }

        return $array;
    }
}

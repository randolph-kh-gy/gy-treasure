<?php

namespace GyTreasure\Framework\Legacy\Issue;

class CodeFormatter
{
    /**
     * @param  string  $id
     * @param  string  $code
     * @return array
     */
    public static function convert($id, $code)
    {
        switch ($id) {
            case 'chongqing_ssc':
                // no break
            case 'fucai3d':
                // no break
            case 'pailie3':
                return static::singleFigureConvert($code);
            case 'bjpk10':
                return static::stripZero(static::commaConvert($code));
            default:
                return static::genericConvert($code);
        }
    }

    /**
     * @param  string  $id
     * @param  array   $winningNumbers
     * @return string
     */
    public static function format($id, array $winningNumbers)
    {
        switch ($id) {
            case 'chongqing_ssc':
                // no break
            case 'fucai3d':
                // no break
            case 'pailie3':
                return static::singleFigureFormat($winningNumbers);
            case 'bjpk10':
                return static::commaFormat(static::padZero($winningNumbers));
            default:
                return static::genericFormat($winningNumbers);
        }
    }

    /**
     * @param  string  $code
     * @return array
     */
    public static function genericConvert($code)
    {
        return explode(' ', $code);
    }

    /**
     * @param  array  $winningNumbers
     * @return string
     */
    public static function genericFormat(array $winningNumbers)
    {
        return implode(' ', $winningNumbers);
    }

    /**
     * @param  string  $code
     * @return array
     */
    public static function singleFigureConvert($code)
    {
        return str_split($code);
    }

    /**
     * @param  array  $winningNumbers
     * @return string
     */
    public static function singleFigureFormat(array $winningNumbers)
    {
        return implode('', $winningNumbers);
    }

    /**
     * @param  string  $code
     * @return array
     */
    public static function commaConvert($code)
    {
        return explode(',', $code);
    }

    /**
     * @param  array  $winningNumbers
     * @return string
     */
    public static function commaFormat(array $winningNumbers)
    {
        return implode(',', $winningNumbers);
    }

    /**
     * @param  array  $winningNumbers
     * @return array
     */
    public static function padZero(array $winningNumbers)
    {
        $returnArray = [];
        foreach ($winningNumbers as $number) {
            $returnArray[] = str_pad($number, 2, '0', STR_PAD_LEFT);
        }
        return $returnArray;
    }

    /**
     * @param  array  $winningNumbers
     * @return array
     */
    public static function stripZero(array $winningNumbers)
    {
        $returnArray = [];
        foreach ($winningNumbers as $number) {
            $returnArray[] = ltrim($number, '0');
        }
        return $returnArray;
    }
}

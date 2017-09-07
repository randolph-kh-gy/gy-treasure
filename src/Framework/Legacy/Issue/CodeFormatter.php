<?php

namespace GyTreasure\Framework\Legacy\Issue;

use GyTreasure\Issue\IssueInfo;

class CodeFormatter
{
    /**
     * @param  string  $id
     * @param  string  $code
     * @return array
     */
    public static function convert($id, $code)
    {
        if (IssueInfo::isSsc($id) || IssueInfo::is3D($id)) {
            return static::singleFigureConvert($code);
        } elseif (IssueInfo::isPK10($id)) {
            return static::stripZero(static::commaConvert($code));
        } else {
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
        if (IssueInfo::isSsc($id) || IssueInfo::is3D($id)) {
            return static::singleFigureFormat($winningNumbers);
        } elseif (IssueInfo::isPK10($id)) {
            return static::commaFormat(static::padZero($winningNumbers));
        } else {
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

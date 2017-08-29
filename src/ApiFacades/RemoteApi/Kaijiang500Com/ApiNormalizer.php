<?php

namespace GyTreasure\ApiFacades\RemoteApi\Kaijiang500Com;

use GyTreasure\ApiFacades\IssueConverter\EightThreeConverter;
use GyTreasure\ApiFacades\IssueConverter\SixDashTwoConverter;

class ApiNormalizer
{
    /**
     * @param  string  $id
     * @param  string  $issue
     * @return string
     */
    public static function formatIssue($id, $issue)
    {
        switch ($id) {
            case 'qihaoxml':    // 重庆时时彩
                return EightThreeConverter::format($issue);
            case 'shdsyxw':     // 十一运夺金, 山东11选5
                // no break;
            case 'dlc':
                // no break;
            case 'gdsyxw':
                return SixDashTwoConverter::format($issue);
            default:
                return $issue;
        }
    }

    /**
     * 格式化开奖号.
     *
     * @param  string  $id
     * @param  array   $numbers
     * @return array
     */
    public static function formatNumbers($id, array $numbers)
    {
        switch ($id) {
            case 'bjpkshi':     // 北京PK拾
                return array_map('static::stripZero', $numbers);
            default:
                return $numbers;
        }
    }

    /**
     * 去除零.
     *
     * @param  string  $string
     * @return string
     */
    protected static function stripZero($string)
    {
        return ltrim($string, '0');
    }
}
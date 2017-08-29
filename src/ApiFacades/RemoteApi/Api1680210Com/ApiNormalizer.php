<?php

namespace GyTreasure\ApiFacades\RemoteApi\Api1680210Com;

use GyTreasure\ApiFacades\IssueConverter\EightThreeConverter;
use GyTreasure\ApiFacades\IssueConverter\EightTwoConverter;
use GyTreasure\ApiFacades\IssueConverter\SixTwoConverter;
use GyTreasure\ApiFacades\IssueConverter\TwoThreeConverter;

class ApiNormalizer
{
    /**
     * @param  string  $id
     * @param  string  $issue
     * @return string
     */
    public static function convertIssue($id, $issue)
    {
        switch ($id) {
            case '10002':   // 重庆时时彩
                return EightThreeConverter::convert($issue);
            case '10008':   // 十一运夺金, 山东11选5
                return SixTwoConverter::convert($issue);
            case '10043':   // 排列3, 体彩P3
                return TwoThreeConverter::convert($issue);
            case '10015':   // 江西11选5
                // no break
            case '10006':   // 广东11选5
                return EightTwoConverter::convert($issue);
            default:
                return $issue;
        }
    }

    /**
     * @param  string  $id
     * @param  string  $issue
     * @return string
     */
    public static function formatIssue($id, $issue)
    {
        switch ($id) {
            case '10002':   // 重庆时时彩
                return EightThreeConverter::format($issue);
            case '10008':   // 十一运夺金, 山东11选5
                return SixTwoConverter::format($issue);
            case '10043':   // 排列3, 体彩P3
                return TwoThreeConverter::format($issue);
            case '10015':   // 江西11选5
                // no break
            case '10006':   // 广东11选5
                return EightTwoConverter::format($issue);
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
            case '10001':     // 北京PK拾
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

<?php

namespace GyTreasure\ApiFacades\RemoteApi\TrendCaipiao163Com;

use GyTreasure\ApiFacades\IssueConverter\SixThreeConverter;
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
            case 'ssc':   // 重庆时时彩
                return SixThreeConverter::convert($issue);
            case 'd11':   // 十一运夺金, 山东11选5
                // no break
            case 'gdd11': // 广东11选5, 粤11选5
                return SixTwoConverter::convert($issue);
            case 'pl3':   // 排列3, 体彩P3
                return TwoThreeConverter::convert($issue);
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
            case 'ssc':   // 重庆时时彩
                return SixThreeConverter::format($issue);
            case 'd11':   // 十一运夺金, 山东11选5
                // no break
            case 'gdd11': // 广东11选5, 粤11选5
                return SixTwoConverter::format($issue);
            case 'pl3':   // 排列3, 体彩P3
                return TwoThreeConverter::format($issue);
            default:
                return $issue;
        }
    }
}

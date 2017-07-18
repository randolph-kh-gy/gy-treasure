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
        switch ($id)
        {
            case 'qihaoxml':    // 重庆时时彩
                return EightThreeConverter::format($issue);
            case 'shdsyxw':     // 十一运夺金, 山东11选5
                return SixDashTwoConverter::format($issue);
            default:
                return $issue;
        }
    }
}
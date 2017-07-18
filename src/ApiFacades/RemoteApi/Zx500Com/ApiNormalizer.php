<?php

namespace GyTreasure\ApiFacades\RemoteApi\Zx500Com;

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
        switch ($id)
        {
            case 'pls':   // 排列3, 体彩P3
                return TwoThreeConverter::convert($issue);
            default:
                return $issue;
        }
    }
}
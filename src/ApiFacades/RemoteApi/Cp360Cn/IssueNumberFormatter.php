<?php

namespace GyTreasure\ApiFacades\RemoteApi\Cp360Cn;

class IssueNumberFormatter
{
    /**
     * 格式化期号.
     *
     * @param  string  $issueNumbers
     * @return array
     */
    public static function format($issueNumbers)
    {
        // 只取 + 号以前的字串
        list($firstSegment) = explode('+', $issueNumbers, 2);

        if (strpos($firstSegment, ' ') !== false) {
            return explode(' ', $firstSegment);
        }
        return str_split($firstSegment);
    }
}
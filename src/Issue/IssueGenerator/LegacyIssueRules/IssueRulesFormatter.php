<?php

namespace GyTreasure\Issue\IssueGenerator\LegacyIssueRules;

use Carbon\Carbon;

/**
 * 格式化输出的期号字串.
 */
class IssueRulesFormatter
{
    /**
     * 取代 [Ymd] 字串.
     * 大小写不敏感
     *
     * @param  string  $format
     * @param  \Carbon\Carbon $date
     * @return string
     */
    public static function replaceYMD($format, Carbon $date)
    {
        return preg_replace_callback('/[ymd]+/i', function ($match) use ($date) {
            return $date->format($match[0]);
        }, $format);
    }

    /**
     * 取代 [n\d+] 字串.
     *
     * @param  string  $format
     * @param  int     $no
     * @return string
     */
    public static function replaceNo($format, $no)
    {
        return preg_replace_callback('/\[n(\d+)\]/', function ($match) use ($no) {
            return str_pad($no, $match[1], '0', STR_PAD_LEFT);
        }, $format);
    }
}

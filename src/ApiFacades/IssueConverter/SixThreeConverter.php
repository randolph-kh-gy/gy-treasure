<?php

namespace GyTreasure\ApiFacades\IssueConverter;

class SixThreeConverter implements IssueConverter
{
    /**
     * 将系统奖期转换 API 奖期格式.
     *
     * @param  string  $issue
     * @return string
     */
    public static function convert($issue)
    {
        return preg_replace('/^20(\d{6})\-(\d{3})$/', '\1\2', $issue);
    }

    /**
     * 将 API 奖期转换成系统奖期格式.
     *
     * @param  string  $issue
     * @return string
     */
    public static function format($issue)
    {
        return preg_replace('/^(\d{6})(\d{3})$/', '20\1-\2', $issue);
    }
}

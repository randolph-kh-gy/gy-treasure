<?php

namespace GyTreasure\ApiFacades\IssueConverter;

interface IssueConverter
{
    /**
     * 将系统奖期转换 API 奖期格式.
     *
     * @param  string  $issue
     * @return string
     */
    public static function convert($issue);

    /**
     * 将 API 奖期转换成系统奖期格式.
     *
     * @param  string  $issue
     * @return string
     */
    public static function format($issue);
}

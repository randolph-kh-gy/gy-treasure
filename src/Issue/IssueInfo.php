<?php

namespace GyTreasure\Issue;

use GyTreasure\Support\Arr;

class IssueInfo
{
    /**
     * @param  string  $id
     * @return bool
     */
    public static function isSsc($id)
    {
        $config = IssueInfoConfig::get($id);
        return Arr::get($config, 'type') == 'ssc';
    }

    /**
     * @param  string  $id
     * @return bool
     */
    public static function is115($id)
    {
        $config = IssueInfoConfig::get($id);
        return Arr::get($config, 'type') == '115';
    }

    /**
     * @param  string  $id
     * @return bool
     */
    public static function isPK10($id)
    {
        $config = IssueInfoConfig::get($id);
        return Arr::get($config, 'type') == 'pk10';
    }

    /**
     * @param  string  $id
     * @return bool
     */
    public static function isOwner($id)
    {
        $config = IssueInfoConfig::get($id);
        return Arr::get($config, 'is_owner', false);
    }
}

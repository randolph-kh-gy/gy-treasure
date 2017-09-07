<?php

namespace GyTreasure\Issue;

use GyTreasure\Support\Arr;

class IssueInfo
{
    const TYPE_SSC  = 'ssc';
    const TYPE_115  = '115';
    const TYPE_3D   = '3d';
    const TYPE_PK10 = 'pk10';

    /**
     * @param  string  $id
     * @return string|null
     */
    public static function type($id)
    {
        return Arr::get(IssueInfoConfig::get($id), 'type');
    }

    /**
     * @param  string  $id
     * @param  string  $type
     * @return bool
     */
    public static function is($id, $type)
    {
        return (static::type($id) == $type);
    }

    /**
     * @param  string  $id
     * @return bool
     */
    public static function isSsc($id)
    {
        return static::is($id, static::TYPE_SSC);
    }

    /**
     * @param  string  $id
     * @return bool
     */
    public static function is115($id)
    {
        return static::is($id, static::TYPE_115);
    }

    public static function is3D($id)
    {
        return static::is($id, static::TYPE_3D);
    }

    /**
     * @param  string  $id
     * @return bool
     */
    public static function isPK10($id)
    {
        return static::is($id, static::TYPE_PK10);
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

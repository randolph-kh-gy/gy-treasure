<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\ElevenFive;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\ApiGetInfo;

class GetElevenFiveInfo extends ApiGetInfo
{
    /**
     * @return string
     */
    protected static function apiPath()
    {
        return 'ElevenFive/getElevenFiveInfo.do';
    }
}
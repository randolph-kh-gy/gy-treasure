<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\ElevenFive;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\GetList;

class GetElevenFiveList extends GetList
{
    /**
     * @return string
     */
    protected static function apiPath()
    {
        return 'ElevenFive/getElevenFiveList.do';
    }
}
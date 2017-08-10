<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\ElevenFive;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\ApiGetList;

class GetElevenFiveList extends ApiGetList
{
    /**
     * @return string
     */
    protected function apiPath()
    {
        return 'ElevenFive/getElevenFiveList.do';
    }
}

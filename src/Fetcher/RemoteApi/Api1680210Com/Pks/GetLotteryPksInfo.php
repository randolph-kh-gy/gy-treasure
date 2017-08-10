<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\Pks;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\ApiGetInfo;

class GetLotteryPksInfo extends ApiGetInfo
{
    /**
     * @return string
     */
    protected function apiPath()
    {
        return 'pks/getLotteryPksInfo.do';
    }
}

<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\QuanGuoCai;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\ApiGetInfo;

class GetLotteryInfo1 extends ApiGetInfo
{
    /**
     * @return string
     */
    protected function apiPath()
    {
        return 'QuanGuoCai/getLotteryInfo1.do';
    }
}

<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\QuanGuoCai;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\ApiGetList;

class GetLotteryInfoList extends ApiGetList
{
    /**
     * @return string
     */
    protected static function apiPath()
    {
        return 'QuanGuoCai/getLotteryInfoList.do';
    }
}

<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\GetList;

class GetBaseCQShiCaiList extends GetList
{
    /**
     * @return string
     */
    protected static function apiPath()
    {
        return 'CQShiCai/getBaseCQShiCaiList.do';
    }
}
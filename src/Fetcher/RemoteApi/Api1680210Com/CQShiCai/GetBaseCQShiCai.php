<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\GetOne;

class GetBaseCQShiCai extends GetOne
{
    /**
     * @return string
     */
    protected static function apiPath()
    {
        return 'CQShiCai/getBaseCQShiCai.do';
    }
}
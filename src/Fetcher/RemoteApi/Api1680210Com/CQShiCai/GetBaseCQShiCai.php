<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\ApiGetInfo;

class GetBaseCQShiCai extends ApiGetInfo
{
    /**
     * @return string
     */
    protected function apiPath()
    {
        return 'CQShiCai/getBaseCQShiCai.do';
    }
}

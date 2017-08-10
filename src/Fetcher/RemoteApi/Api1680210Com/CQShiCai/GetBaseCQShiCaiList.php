<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\ApiGetList;

class GetBaseCQShiCaiList extends ApiGetList
{
    /**
     * @return string
     */
    protected function apiPath()
    {
        return 'CQShiCai/getBaseCQShiCaiList.do';
    }
}

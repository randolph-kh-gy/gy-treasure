<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\Pks;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\ApiGetList;

class GetPksHistoryList extends ApiGetList
{
    /**
     * @return string
     */
    protected function apiPath()
    {
        return 'pks/getPksHistoryList.do';
    }
}

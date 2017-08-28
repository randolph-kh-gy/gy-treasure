<?php

namespace GyTreasure\Fetcher\RemoteApi\WwwPk10Me\Pk10;

use GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiRequest;
use GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiPrototype\HistoryData;

class GetHistoryData extends HistoryData
{
    /**
     * @return static
     */
    public static function forge()
    {
        return new static(ApiRequest::forge());
    }

    /**
     * @return string
     */
    protected function apiPath()
    {
        return 'pk10/getHistoryData';
    }
}

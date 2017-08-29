<?php

namespace GyTreasure\Fetcher\RemoteApi\WwwPk10Me\Pk10;

use GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiPrototype\ApiGetData;
use GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiRequest;

class GetData extends ApiGetData
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
        return 'pk10/getData';
    }
}

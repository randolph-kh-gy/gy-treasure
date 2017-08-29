<?php

namespace GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Pk10;

use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\ApiPrototype\ApiAjax;
use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\ApiRequest;

class Ajax extends ApiAjax
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
        return 'pk10/ajax';
    }
}
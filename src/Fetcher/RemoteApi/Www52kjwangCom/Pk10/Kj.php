<?php

namespace GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Pk10;

use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\ApiPrototype\ApiGetList;
use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\XmlHttpRequest;

class Kj extends ApiGetList
{
    /**
     * @return static
     */
    public static function forge()
    {
        return new static(XmlHttpRequest::forge());
    }

    /**
     * @return string
     */
    protected function apiPath()
    {
        return 'pk10/kj';
    }
}

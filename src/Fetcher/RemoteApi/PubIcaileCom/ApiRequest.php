<?php

namespace GyTreasure\Fetcher\RemoteApi\PubIcaileCom;

use GyTreasure\Fetcher\Request;
use GyTreasure\Fetcher\RemoteApi\SimpleJson\SimpleJsonApiRequest;

class ApiRequest extends SimpleJsonApiRequest
{
    /**
     * @return static
     */
    public static function forge()
    {
        return new static(Request::forge());
    }

    /**
     * @return string
     */
    public function baseUrl()
    {
        return 'http://pub.icaile.com/';
    }
}
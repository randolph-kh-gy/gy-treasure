<?php

namespace GyTreasure\Fetcher\RemoteApi\Old1680210Com;

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
     * API 位址
     *
     * @return string
     */
    public function baseUrl()
    {
        return 'http://old.1680210.com/';
    }
}
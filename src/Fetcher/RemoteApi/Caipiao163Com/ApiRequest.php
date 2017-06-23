<?php

namespace GyTreasure\Fetcher\RemoteApi\Caipiao163Com;

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
        return 'http://caipiao.163.com/';
    }
}
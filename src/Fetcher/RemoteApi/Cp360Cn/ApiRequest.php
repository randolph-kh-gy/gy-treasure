<?php

namespace GyTreasure\Fetcher\RemoteApi\Cp360Cn;

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
        return 'http://cp.360.cn/';
    }
}
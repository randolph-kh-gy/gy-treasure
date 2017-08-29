<?php

namespace GyTreasure\Fetcher\RemoteApi\Www52kjwangCom;

use GyTreasure\Fetcher\RemoteApi\SimpleJson\SimpleAjaxJsonApiRequest;
use GyTreasure\Fetcher\Request;

class ApiRequest extends SimpleAjaxJsonApiRequest
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
        return 'http://www.52kjwang.com/';
    }
}
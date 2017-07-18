<?php

namespace GyTreasure\Fetcher\RemoteApi\Cp360Cn;

use GyTreasure\Fetcher\RemoteApi\GBKHtmlRequest;
use GyTreasure\Fetcher\Request;

class HtmlRequest extends GBKHtmlRequest
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
        return 'http://cp.360.cn/';
    }
}

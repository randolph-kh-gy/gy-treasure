<?php

namespace GyTreasure\Fetcher\RemoteApi\Caipiao163Com;

use GyTreasure\Fetcher\RemoteApi\BaseHtmlRequest;
use GyTreasure\Fetcher\Request;

class HtmlRequest extends BaseHtmlRequest
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

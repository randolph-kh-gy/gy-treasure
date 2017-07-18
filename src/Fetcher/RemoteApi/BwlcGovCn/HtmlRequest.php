<?php

namespace GyTreasure\Fetcher\RemoteApi\BwlcGovCn;

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
        return 'http://www.bwlc.gov.cn/';
    }
}

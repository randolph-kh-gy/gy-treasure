<?php

namespace GyTreasure\Fetcher\RemoteApi\Zx500Com;

use GyTreasure\Fetcher\RemoteApi\SimpleXml\SimpleXmlApiRequest;
use GyTreasure\Fetcher\Request;

class XmlRequest extends SimpleXmlApiRequest
{
    /**
     * @return static
     */
    public static function forge()
    {
        return new static(Request::forge());
    }

    /**
     * API 位址.
     *
     * @return string
     */
    public function baseUrl()
    {
        return 'http://zx.500.com/';
    }
}

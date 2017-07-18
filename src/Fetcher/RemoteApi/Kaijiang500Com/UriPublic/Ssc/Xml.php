<?php

namespace GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\UriPublic\Ssc;

use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Xml as BaseXml;

class Xml extends BaseXml
{
    /**
     * @return string
     */
    protected function apiPath()
    {
        return 'static/public/ssc/xml';
    }
}

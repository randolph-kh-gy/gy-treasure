<?php

namespace GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Xml as BaseXml;

class Xml extends BaseXml
{
    /**
     * @return string
     */
    protected function apiPath()
    {
        return 'static/info/kaijiang/xml';
    }
}

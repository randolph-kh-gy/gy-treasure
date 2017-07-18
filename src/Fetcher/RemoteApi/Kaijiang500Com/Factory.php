<?php

namespace GyTreasure\Fetcher\RemoteApi\Kaijiang500Com;

use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang\Xml as InfoXml;
use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\UriPublic\Ssc\Xml as SscXml;

class Factory
{
    /**
     * @param  string  $id
     * @return \GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Xml
     */
    public function make($id)
    {
        switch ($id) {
            case 'qihaoxml':
                return SscXml::forge();
            default:
                return InfoXml::forge();
        }
    }
}

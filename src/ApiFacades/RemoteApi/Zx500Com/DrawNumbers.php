<?php

namespace GyTreasure\ApiFacades\RemoteApi\Zx500Com;

use GyTreasure\ApiFacades\Interfaces\ApiFromIssue;
use GyTreasure\Fetcher\RemoteApi\Zx500Com\Info\Kaijiang\Xml;

class DrawNumbers implements ApiFromIssue
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Zx500Com\Info\Kaijiang\Xml
     */
    protected $api;

    /**
     * DrawNumbers constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Zx500Com\Info\Kaijiang\Xml $xml
     */
    public function __construct(Xml $xml)
    {
        $this->api = $xml;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(Xml::forge());
    }

    /**
     * 撷取指定号码
     *
     * @param  string  $id
     * @param  string  $issue
     * @return array|null
     */
    public function fromIssue($id, $issue)
    {
        return $this->api->call($id, $issue);
    }
}

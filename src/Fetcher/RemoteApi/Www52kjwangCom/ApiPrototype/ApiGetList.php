<?php

namespace GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\ApiPrototype;

use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\HtmlTableParser;
use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\XmlHttpRequest;

abstract class ApiGetList
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\XmlHttpRequest
     */
    protected $xmlHttpRequest;

    /**
     * Kj constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\XmlHttpRequest $xmlHttpRequest
     */
    public function __construct(XmlHttpRequest $xmlHttpRequest)
    {
        $this->xmlHttpRequest = $xmlHttpRequest;
    }

    /**
     * @return string
     */
    abstract protected function apiPath();

    /**
     * @param  string|null  $date
     * @return array
     */
    public function call($date = null)
    {
        $html   = $this->xmlHttpRequest->call($this->apiPath(), compact('date'));

        $parser = new HtmlTableParser();
        return $parser->parse($html);
    }
}

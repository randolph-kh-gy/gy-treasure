<?php

namespace GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Pk10;

use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\XmlHttpRequest;

class Kj
{
    const API_PATH = 'pk10/kj';

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
     * @return static
     */
    public static function forge()
    {
        return new static(XmlHttpRequest::forge());
    }

    public function call($date = null)
    {
        $html = $this->xmlHttpRequest->call(static::API_PATH, compact('date'));
        // TODO 未完成分析
        return $html;
    }
}

<?php

namespace GyTreasure\Fetcher\RemoteApi\Zx500Com\Info\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\Zx500Com\XmlRequest;

class Xml
{
    CONST API_PATH = 'static/info/kaijiang/xml';

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Zx500Com\XmlRequest
     */
    protected $xmlRequest;

    /**
     * Xml constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Zx500Com\XmlRequest $xmlRequest
     */
    public function __construct(XmlRequest $xmlRequest)
    {
        $this->xmlRequest = $xmlRequest;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(XmlRequest::forge());
    }

    /**
     * 撷取当期号码.
     *
     * @param  string  $id
     * @param  string  $issue
     * @return array|null
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call($id, $issue)
    {
        $path   = static::API_PATH . '/' . $id . '/' . $issue . '.xml';
        $xml    = $this->xmlRequest->call($path);
        $result = (string) $xml->Result;
        return $result ? explode(',', $result) : null;
    }
}

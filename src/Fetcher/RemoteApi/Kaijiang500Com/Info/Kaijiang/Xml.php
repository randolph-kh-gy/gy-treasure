<?php

namespace GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\XmlRequest;

class Xml
{
    CONST API_PATH = 'static/info/kaijiang/xml';

    protected $xmlRequest;

    /**
     * Xml constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\XmlRequest $xmlRequest
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
     * @param  string  $id
     * @param  string  $date
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call($id, $date)
    {
        $date = date('Ymd', strtotime($date));
        $path = static::API_PATH . '/' . $id . '/' . $date . '.xml';

        $xml = $this->xmlRequest->call($path);

        $returnArray = [];
        foreach ($xml->row as $row) {
            $expect     = (string) $row->attributes()->expect;
            $opencode   = explode(',', strval($row->attributes()->opencode));

            $returnArray[] = compact('expect', 'opencode');
        }

        return $returnArray;
    }
}

<?php

namespace GyTreasure\Fetcher\RemoteApi\Kaijiang500Com;

abstract class Xml
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\XmlRequest
     */
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
     * @return string
     */
    abstract protected function apiPath();

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
        $path = $this->apiPath() . '/' . $id . '/' . $date . '.xml';

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

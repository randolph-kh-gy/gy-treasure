<?php

namespace GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\XmlRequest;

class Xml
{
    CONST API_PATH = 'static/info/kaijiang/xml';

    protected $xmlRequest;

    public function __construct(XmlRequest $xmlRequest)
    {
        $this->xmlRequest = $xmlRequest;
    }

    public static function forge()
    {
        return new static(XmlRequest::forge());
    }

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

        print_r($returnArray);

        // $rows = iterator_to_array($xml->row, 0);

        // print_r($rows);
    }
}
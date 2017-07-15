<?php

namespace GyTreasure\ApiFacades\RemoteApi\Kaijiang500Com;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang\Xml;

class DrawNumbers implements ApiDrawDateGroupIssues
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang\Xml
     */
    protected $api;

    /**
     * DrawNumbers constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang\Xml $xml
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
     * 取得指定日期的开号.
     *
     * @param  string  $id
     * @param  \Carbon\Carbon  $date
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function drawDateGroupIssues($id, Carbon $date)
    {
        $data = $this->api->call($id, $date->toDateString());
        return array_map([$this, 'format'], $data);
    }

    /**
     * @param  array  $row
     * @return array
     */
    protected function format(array $row)
    {
        return [
            'winningNumbers' => $row['opencode'],
            'issue'          => $row['expect'],
        ];
    }
}

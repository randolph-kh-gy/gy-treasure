<?php

namespace GyTreasure\ApiFacades\RemoteApi\TrendCaipiao163Com;

use GyTreasure\ApiFacades\Interfaces\ApiDrawRangeIssues;
use GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\DownloadTrendAwardNumber;

class DrawNumbers implements ApiDrawRangeIssues
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\DownloadTrendAwardNumber
     */
    protected $api;

    /**
     * DrawNumbers constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\DownloadTrendAwardNumber $api
     */
    public function __construct(DownloadTrendAwardNumber $api)
    {
        $this->api = $api;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(DownloadTrendAwardNumber::forge());
    }

    /**
     * 撷取指定范围号码.
     *
     * @param  string  $id
     * @param  string  $from
     * @param  string  $to
     * @return array
     */
    public function drawRangeIssues($id, $from, $to)
    {
        $from = ApiNormalizer::convertIssue($id, $from);
        $to   = ApiNormalizer::convertIssue($id, $to);
        $data = $this->api->call($id, $from, $to);

        // 格式化期号格式
        array_walk($data, function (&$row) use ($id) {
            $row['issue'] = ApiNormalizer::formatIssue($id, $row['issue']);
        });

        return $data;
    }
}

<?php

/**
 * 爱彩乐号源 - 重庆时时彩
 */

namespace GyTreasure\Fetcher\RemoteApi\PubIcaileCom;

use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException;

class Cqssckjjg
{
    const API_PATH = 'cqssckjjg.php';

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\PubIcaileCom\ApiRequest
     */
    protected $apiRequest;

    /**
     * Cqssckjjg constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\PubIcaileCom\ApiRequest $apiRequest
     */
    public function __construct(ApiRequest $apiRequest)
    {
        $this->apiRequest = $apiRequest;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(ApiRequest::forge());
    }

    /**
     * 取得图表资料.
     *
     * @param  string  $action
     * @param  string  $date
     * @param  int     $id
     * @param  string  $async
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call($action = 'chart', $date = 'today', $id = 503, $async = 'true')
    {
        $query = compact('action', 'date', 'id', 'async');
        $data = $this->apiRequest->call(static::API_PATH, $query);

        if (! isset($data['data']) || ! is_array($data['data'])) {
            throw new ApiParseException('Failed to parse the api response.');
        }

        return $data['data'];
    }
}
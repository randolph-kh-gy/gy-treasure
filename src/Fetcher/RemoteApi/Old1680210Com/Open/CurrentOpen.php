<?php

namespace GyTreasure\Fetcher\RemoteApi\Old1680210Com\Open;

use GyTreasure\Fetcher\RemoteApi\Old1680210Com\ApiRequest;

class CurrentOpen
{
    const API_PATH = 'Open/CurrentOpen';

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Old1680210Com\ApiRequest
     */
    protected $apiRequest;

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
     * @param  string  $code
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call($code)
    {
        return $this->apiRequest->call(static::API_PATH, compact('code'));
    }
}
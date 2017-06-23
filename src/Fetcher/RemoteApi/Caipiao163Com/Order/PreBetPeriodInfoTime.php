<?php

namespace GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Order;

use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\ApiRequest;

class PreBetPeriodInfoTime
{
    const API_PATH = 'order/preBet_periodInfoTime.html';

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\ApiRequest
     */
    protected $apiRequest;

    /**
     * PreBetPeriodInfoTime constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\ApiRequest $apiRequest
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
     * @param  array  $data
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\SimpleJson\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\SimpleJson\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call(array $data = [])
    {
        return $this->apiRequest->call(static::API_PATH, $data);
    }
}
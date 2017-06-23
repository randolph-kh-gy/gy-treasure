<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com;

abstract class ApiCall
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiRequest
     */
    protected $request;

    /**
     * getBaseCQShiCai constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiRequest $request
     */
    public function __construct(ApiRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return static
     */
    public function forge()
    {
        return new static(ApiRequest::forge());
    }

    /**
     * @param  string  $path
     * @param  string  $query
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiBusiness
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiErrorException API 错误
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     */
    protected function _apiCall($path, $query)
    {
        $response = $this->request->call($path, $query);
        $business = new ApiBusiness($response);
        return $business;
    }
}
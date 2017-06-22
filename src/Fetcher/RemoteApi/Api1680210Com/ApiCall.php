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
     * @param  string  $path
     * @param  string  $query
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiBusiness
     */
    protected function _apiCall($path, $query)
    {
        $response = $this->request->call($path, $query);
        $business = new ApiBusiness($response);
        return $business;
    }
}
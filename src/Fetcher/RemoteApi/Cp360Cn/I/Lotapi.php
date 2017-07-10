<?php

namespace GyTreasure\Fetcher\RemoteApi\Cp360Cn\I;

use GyTreasure\Fetcher\RemoteApi\Cp360Cn\ApiRequest;

class Lotapi
{
    const API_PATH = 'i/lotapi.html';

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Cp360Cn\ApiRequest
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

    public function call($do, $lotID, $issue)
    {
        $query = ['datatype' => 'json'] + compact('do', 'lotID', 'issue');
        return $this->apiRequest->call(static::API_PATH, $query);
    }
}
<?php

namespace GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiPrototype;

use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException;
use GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiRequest;

abstract class ApiGetData
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiRequest
     */
    protected $apiRequest;

    /**
     * GetData constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiRequest $apiRequest
     */
    public function __construct(ApiRequest $apiRequest)
    {
        $this->apiRequest = $apiRequest;
    }

    /**
     * @return string
     */
    abstract protected function apiPath();

    /**
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException
     */
    public function call()
    {
        $data = $this->apiRequest->call($this->apiPath());

        if (! is_array($data) || ! isset($data['current']) || ! is_array($data['current'])) {
            throw new ApiParseException('Failed to parse the api response.');
        }

        return $data['current'];
    }
}

<?php

namespace GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiPrototype;

use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException;
use GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiRequest;

abstract class HistoryData
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\WwwPk10Me\ApiRequest
     */
    protected $apiRequest;

    /**
     * GetHistoryData constructor.
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
     * @param  string|null  $count
     * @param  string|null  $date
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call($count = null, $date = null)
    {
        $query = compact('count', 'date');
        $data  = $this->apiRequest->call($this->apiPath(), $query);

        $success = ! empty($data['success']);

        if (! $success || ! isset($data['rows']) || ! is_array($data['rows'])) {
            throw new ApiParseException('Failed to parse the api response.');
        }

        return $data['rows'];
    }
}
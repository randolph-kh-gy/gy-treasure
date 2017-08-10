<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiCall;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiCallForgeWithNoArgs;

abstract class ApiGetInfo extends ApiCall
{
    use ApiCallForgeWithNoArgs;

    /**
     * @return string
     */
    abstract protected function apiPath();

    /**
     * @param  string  $issue
     * @param  string  $lotCode
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiBusiness
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiParseException 无法分析 API 回应
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiErrorException API 错误
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiUnreachableException 無法取得 API
     */
    public function call($issue, $lotCode)
    {
        $query = compact('issue', 'lotCode');
        return $this->_apiCall($this->apiPath(), $query);
    }
}
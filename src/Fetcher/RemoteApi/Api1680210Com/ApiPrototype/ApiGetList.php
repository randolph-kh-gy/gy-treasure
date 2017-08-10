<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiCall;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiCallForgeWithNoArgs;

abstract class ApiGetList extends ApiCall
{
    use ApiCallForgeWithNoArgs;

    /**
     * @return string
     */
    abstract protected function apiPath();

    /**
     * @param  string       $lotCode
     * @param  string|null  $date
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiBusiness
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiErrorException API 错误
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     */
    public function call($lotCode, $date = null)
    {
        $query = compact('date', 'lotCode');
        return $this->_apiCall($this->apiPath(), $query);
    }
}

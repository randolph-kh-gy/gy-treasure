<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiCall;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiCallForgeWithNoArgs;

class getBaseCQShiCai extends ApiCall
{
    use ApiCallForgeWithNoArgs;

    const API_PATH = 'CQShiCai/getBaseCQShiCai.do';

    /**
     * @param  string  $issue
     * @param  string  $lotCode
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiBusiness
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiParseException 无法分析 API 回应
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiErrorException API 错误
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiUnreachableException 無法取得 API
     */
    public static function call($issue, $lotCode)
    {
        $instance = static::forge();
        return $instance->remoteCall($issue, $lotCode);
    }

    /**
     * @param  string  $issue
     * @param  string  $lotCode
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiBusiness
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiParseException 无法分析 API 回应
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiErrorException API 错误
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiUnreachableException 無法取得 API
     */
    public function remoteCall($issue, $lotCode)
    {
        $query = compact('issue', 'lotCode');
        return $this->_apiCall(static::API_PATH, $query);
    }
}
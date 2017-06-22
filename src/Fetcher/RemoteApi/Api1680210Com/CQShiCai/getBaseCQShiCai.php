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
     */
    public function remoteCall($issue, $lotCode)
    {
        $query = compact('issue', 'lotCode');
        return $this->_apiCall(static::API_PATH, $query);
    }
}
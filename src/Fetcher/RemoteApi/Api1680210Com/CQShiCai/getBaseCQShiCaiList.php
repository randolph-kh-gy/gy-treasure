<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiCall;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiCallForgeWithNoArgs;

class getBaseCQShiCaiList extends ApiCall
{
    use ApiCallForgeWithNoArgs;

    const API_PATH = 'CQShiCai/getBaseCQShiCaiList.do';

    /**
     * @param  string  $lotCode
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiBusiness
     */
    public static function call($lotCode)
    {
        $instance = static::forge();
        return $instance->remoteCall($lotCode);
    }

    /**
     * @param  string  $lotCode
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiBusiness
     */
    public function remoteCall($lotCode)
    {
        $query = compact('lotCode');
        return $this->_apiCall(static::API_PATH, $query);
    }
}
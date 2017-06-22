<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com;

trait ApiCallForgeWithNoArgs
{
    /**
     * @return static
     */
    public static function forge()
    {
        return new static(ApiRequest::forge());
    }
}
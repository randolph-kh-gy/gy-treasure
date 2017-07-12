<?php

namespace GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin;

interface PrevInterface
{
    /**
     * @param  string|null  $num
     * @param  string|null  $dates
     * @param  int  $page
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call($num = null, $dates = null, $page = 1);
}

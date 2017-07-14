<?php

namespace GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang;

interface HistoryListInterface
{
    /**
     * @param  string|null  $lotId
     * @param  string|null  $spanType
     * @param  string|null  $span
     * @return array
     */
    public function call($lotId = null, $spanType = null, $span = null);
}
<?php

namespace GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HtmlRequest;

class Sd
{
    const API_PATH = 'kaijiang/sd';

    protected $htmlRequest;

    public function __construct(HtmlRequest $htmlRequest)
    {
        $this->htmlRequest = $htmlRequest;
    }

    /**
     * @param  string  $lotId
     * @param  string  $spanType
     * @param  string|null $span
     * @return array
     */
    public function call($lotId, $spanType, $span = null)
    {
        $query = compact('lotId', 'spanType');
        return [];
    }
}

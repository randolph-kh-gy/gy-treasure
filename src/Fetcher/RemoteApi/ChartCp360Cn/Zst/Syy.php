<?php

namespace GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Zst;

use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HistoryListInterface;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HtmlRequest;

class Syy implements HistoryListInterface
{
    const API_PATH = 'zst/syy';

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HtmlRequest
     */
    protected $htmlRequest;

    /**
     * Syy constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HtmlRequest $htmlRequest
     */
    public function __construct(HtmlRequest $htmlRequest)
    {
        $this->htmlRequest = $htmlRequest;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(HtmlRequest::forge());
    }

    /**
     * @param  string|null  $lotId
     * @param  string|null  $spanType
     * @param  string|null  $span
     * @return array
     */
    public function call($lotId = null, $spanType = null, $span = null)
    {
        $chartType  = 'rxfb';
        $query      = compact('lotId', 'chartType', 'spanType', 'span');
        $html       = $this->htmlRequest->call(static::API_PATH, $query);

        $parser     = new HtmlTableParser();
        $data       = $parser->parse($html);

        return $data;
    }
}

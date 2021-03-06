<?php

namespace GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin;

use GyTreasure\Fetcher\RemoteApi\BwlcGovCn\HtmlRequest;
use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException;

class Prevtrax implements PrevInterface
{
    const API_PATH = 'bulletin/prevtrax.html';

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\BwlcGovCn\HtmlRequest
     */
    protected $htmlRequest;

    /**
     * GetAwardNumberInfo constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\BwlcGovCn\HtmlRequest $htmlRequest
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
     * @param  string|null  $num
     * @param  string|null  $dates
     * @param  int  $page
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call($num = null, $dates = null, $page = 1)
    {
        $query  = compact('num', 'dates', 'page');
        $html   = $this->htmlRequest->call(static::API_PATH, $query);

        $parser = new PrevtraxParser();
        $rows   = $parser->parse($html);

        if ($rows === null) {
            throw new ApiParseException('Failed to parse the api response.');
        }

        return $rows;
    }
}

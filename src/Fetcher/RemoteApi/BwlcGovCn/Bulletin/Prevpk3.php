<?php

namespace GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin;

use GyTreasure\Fetcher\RemoteApi\BwlcGovCn\HtmlRequest;
use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException;

class Prevpk3
{
    const API_PATH = 'bulletin/prevpk3.html';

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\BwlcGovCn\HtmlRequest
     */
    protected $htmlRequest;

    /**
     * Prevpk3 constructor.
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
     * @param  int  $page
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call($num = null, $page = 1)
    {
        $query  = compact('num', 'page');
        $html   = $this->htmlRequest->call(static::API_PATH, $query);

        $parser = new Prevpk3Parser();
        $rows   = $parser->parse($html);

        if ($rows === null) {
            throw new ApiParseException('Failed to parse the api response.');
        }

        return $rows;
    }
}

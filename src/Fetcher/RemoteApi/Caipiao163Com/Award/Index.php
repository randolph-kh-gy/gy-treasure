<?php

namespace GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award;

use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\HtmlRequest;

class Index
{
    const API_PATH = 'award/';

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\HtmlRequest
     */
    protected $htmlRequest;

    /**
     * Index constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\HtmlRequest $htmlRequest
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
     * @return array
     */
    public function call()
    {
        $html = $this->htmlRequest->call(static::API_PATH);
        $parser = new HallHtmlTableParser();
        return $parser->parse($html);
    }
}
<?php

namespace GyTreasure\Fetcher\RemoteApi\Cp360Cn\Kj;

use GyTreasure\Fetcher\RemoteApi\Cp360Cn\HtmlRequest;

class Kaijiang
{
    const API_PATH = 'kj/kaijiang.html';

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Cp360Cn\HtmlRequest
     */
    protected $htmlRequest;

    /**
     * Kaijiang constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Cp360Cn\HtmlRequest $htmlRequest
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

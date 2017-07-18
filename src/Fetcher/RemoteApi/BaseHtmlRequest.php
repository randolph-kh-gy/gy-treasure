<?php

namespace GyTreasure\Fetcher\RemoteApi;

use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException;
use GyTreasure\Fetcher\Request;

abstract class BaseHtmlRequest extends BaseApiRequest
{
    /**
     * @var \GyTreasure\Fetcher\Request
     */
    protected $request;

    /**
     * HtmlRequest constructor.
     * @param \GyTreasure\Fetcher\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 呼叫 API
     *
     * @param  string  $path
     * @param  array   $query
     * @return string
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     */
    public function call($path, array $query = [])
    {
        $url = $this->apiUrl($path, $query);

        $response = $this->request->get($url);

        if ($response === null) {
            throw new ApiUnreachableException('API is unreachable.');
        }

        return $this->parseResponse($response);
    }

    /**
     * @param  string  $response
     * @return string
     */
    protected function parseResponse($response)
    {
        return $response;
    }
}

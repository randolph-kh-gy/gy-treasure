<?php

namespace GyTreasure\Fetcher\RemoteApi\Kaijiang500Com;

use GyTreasure\Fetcher\Request;
use GyTreasure\Fetcher\RemoteApi\BaseApiRequest;
use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException;
use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException;

class XmlRequest extends BaseApiRequest
{
    /**
     * @var \GyTreasure\Fetcher\Request
     */
    protected $request;

    /**
     * Constructor
     * @param \GyTreasure\Fetcher\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(Request::forge());
    }

    /**
     * API 位址
     *
     * @return string
     */
    public function baseUrl()
    {
        return 'http://kaijiang.500.com/';
    }

    /**
     * 呼叫 API
     *
     * @param  string  $path
     * @param  array   $query
     * @return \SimpleXMLElement
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
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
     * @return \SimpleXMLElement
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    protected function parseResponse($response)
    {
        // disable warnings.
        $saved = libxml_use_internal_errors(true);

        $xml = simplexml_load_string($response);

        if (! $xml) {
            libxml_clear_errors();
            libxml_use_internal_errors($saved);

            throw new ApiParseException('Failed to parse the api response.');
        }

        libxml_use_internal_errors($saved);

        return $xml;
    }
}
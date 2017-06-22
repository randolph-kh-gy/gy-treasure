<?php

namespace GyTreasure\Fetcher\RemoteApi\Old1680210Com;

use GyTreasure\Fetcher\Request;
use GyTreasure\Fetcher\RemoteApi\BaseApiRequest;
use GyTreasure\Fetcher\RemoteApi\Old1680210Com\Exceptions\ApiUnreachableException;
use GyTreasure\Fetcher\RemoteApi\Old1680210Com\Exceptions\ApiParseException;

class ApiRequest extends BaseApiRequest
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
     * 呼叫 API
     *
     * @param  string  $path
     * @param  array   $query
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Old1680210Com\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Old1680210Com\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call($path, $query)
    {
        $url = $this->apiUrl($path, $query);

        $response = $this->request->get($url);

        if ($response === null) {
            throw new ApiUnreachableException('API is unreachable.');
        }

        $data = json_decode($response, true);

        if (! is_array($data)) {
            throw new ApiParseException('Failed to parse the api response.');
        }

        return $data;
    }

    /**
     * API 位址
     *
     * @return string
     */
    public function baseUrl()
    {
        return 'http://old.1680210.com/';
    }
}
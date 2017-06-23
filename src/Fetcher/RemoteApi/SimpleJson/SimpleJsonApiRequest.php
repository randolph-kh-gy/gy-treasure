<?php

namespace GyTreasure\Fetcher\RemoteApi\SimpleJson;

use GyTreasure\Fetcher\Request;
use GyTreasure\Fetcher\RemoteApi\BaseApiRequest;
use GyTreasure\Fetcher\RemoteApi\SimpleJson\Exceptions\ApiUnreachableException;
use GyTreasure\Fetcher\RemoteApi\SimpleJson\Exceptions\ApiParseException;

abstract class SimpleJsonApiRequest extends BaseApiRequest
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
     * 呼叫 API
     *
     * @param  string  $path
     * @param  array   $query
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\SimpleJson\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\SimpleJson\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call($path, array $query = [])
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
}
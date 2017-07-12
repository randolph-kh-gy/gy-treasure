<?php

namespace GyTreasure\Fetcher\RemoteApi\ChartCp360Cn;

use GyTreasure\Fetcher\RemoteApi\BaseApiRequest;
use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException;
use GyTreasure\Fetcher\Request;

class HtmlRequest extends BaseApiRequest
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public static function forge()
    {
        return new static(Request::forge());
    }

    public function baseUrl()
    {
        return 'http://chart.cp.360.cn/';
    }

    /**
     * 呼叫 API
     *
     * @param  string  $path
     * @param  array   $query
     * @return array
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

        return $response;
    }
}
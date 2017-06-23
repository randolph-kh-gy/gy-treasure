<?php

namespace GyTreasure\Fetcher\RemoteApi\Caipiao163Com;

use GyTreasure\Fetcher\Request;
use GyTreasure\Fetcher\RemoteApi\BaseApiRequest;

class ApiRequest extends BaseApiRequest
{
    /**
     * @var \GyTreasure\Fetcher\Request
     */
    protected $request;

    /**
     * ApiRequest constructor.
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
     * @param  string  $path
     * @param  array   $query
     * @return array
     */
    public function call($path, array $query = [])
    {
        $url = $this->apiUrl($path, $query);

        $response = $this->request->get($url);

        // TODO 需要判断 exceptions

        $data = json_decode($response, true);

        return $data;
    }

    /**
     * @return string
     */
    public function baseUrl()
    {
        return 'http://caipiao.163.com/';
    }
}
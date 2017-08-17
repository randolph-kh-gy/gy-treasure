<?php

namespace GyTreasure\Fetcher\RemoteApi\Www52kjwangCom;

use GyTreasure\Fetcher\RemoteApi\BaseApiRequest;
use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException;
use GyTreasure\Fetcher\Request;

class XmlHttpRequest extends BaseApiRequest
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
     * @return string
     */
    public function baseUrl()
    {
        return 'http://www.52kjwang.com/';
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

        $response = $this->request->get($url, [
            'headers' => ['X-Requested-With' => 'XMLHttpRequest'],
        ]);

        if ($response === null) {
            throw new ApiUnreachableException('API is unreachable.');
        }

        return $response;
    }
}

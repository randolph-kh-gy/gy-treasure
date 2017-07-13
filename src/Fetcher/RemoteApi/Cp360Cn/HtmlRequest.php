<?php

namespace GyTreasure\Fetcher\RemoteApi\Cp360Cn;

use GyTreasure\Fetcher\RemoteApi\BaseApiRequest;
use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException;
use GyTreasure\Fetcher\Request;

class HtmlRequest extends BaseApiRequest
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
        return 'http://cp.360.cn/';
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

        return $this->convertGBK($response);
    }

    /**
     * 转换 GBK 编码.
     *
     * @param  string  $html
     * @return string
     */
    public function convertGBK($html)
    {
        $encoding = mb_detect_encoding($html, ['UTF-8', 'GBK']);

        if ($encoding == 'UTF-8') {
            return $html;
        } else {
            return mb_convert_encoding($html, 'UTF-8', 'GBK');
        }
    }
}
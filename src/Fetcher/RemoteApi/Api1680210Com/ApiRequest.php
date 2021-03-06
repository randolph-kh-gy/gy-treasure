<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com;

use GyTreasure\Fetcher\Request;
use GyTreasure\Fetcher\RemoteApi\BaseApiRequest;
use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException;
use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiErrorException;
use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException;

class ApiRequest extends BaseApiRequest
{
    /**
     * @var \GyTreasure\Fetcher\Request
     */
    protected $request;

    /**
     * HtmlRequest constructor.
     *
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
     * @return ApiResponse
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiErrorException API 错误
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
     * API 位址
     *
     * @return string
     */
    public function baseUrl()
    {
        return 'http://api.1680210.com/';
    }

    /**
     * 解析回应
     *
     * @param  string  $response
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiResponse
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiErrorException API 错误
     */
    public function parseResponse($response)
    {
        $response = json_decode($response, true);
        if (! $this->_isParseable($response)) {
            throw new ApiParseException('Failed to parse the api response.');
        }

        if ($response['errorCode'] != 0) {
            throw new ApiErrorException($response['message'], $response['errorCode'], $response);
        }

        return new ApiResponse($response['message'], $response['result']);
    }

    /**
     * 回传 API 回应是否能被分析
     *
     * @param  array|bool|null $data
     * @return bool
     */
    protected static function _isParseable($data)
    {
        // 确定是否为阵列
        if (! is_array($data)) {
            return false;
        }

        // 需要有 errorCode, message 及 result 栏位
        if (! isset($data['errorCode']) || ! isset($data['message']) || ! isset($data['result'])) {
            return false;
        }

        return true;
    }
}
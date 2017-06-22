<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com;

use GyTreasure\Fetcher\Request;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiParseException;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiErrorException;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiUnreachableException;

class ApiRequest
{
    /**
     * @var \GyTreasure\Fetcher\Request
     */
    protected $request;

    /**
     * ApiRequest constructor.
     *
     * @param \GyTreasure\Fetcher\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiRequest
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
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiParseException 无法分析 API 回应
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiErrorException API 错误
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiUnreachableException 無法取得 API
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
     * 取得实际上 API 的 URL.
     *
     * @param  string  $path  API 路径
     * @param  array   $query
     * @return string
     */
    public function apiUrl($path, array $query = [])
    {
        $baseUrl = $this->baseUrl() . $this->_normalizePath($path);
        return ($query) ? $baseUrl . '?' . http_build_query($query) : $baseUrl;
    }

    /**
     * 解析回应
     *
     * @param  string  $response
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiResponse
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiParseException 无法分析 API 回应
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiErrorException API 错误
     */
    public function parseResponse($response)
    {
        $response = json_decode($response, true);
        if (! $this->_isParseable($response)) {
            throw new ApiParseException("Failed to parse the api response.");
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
        if (! isset($data['errorCode']) || ! isset($data['message']) || ! isset($data['result']))
        {
            return false;
        }

        return true;
    }

    /**
     * 正规化路径
     *
     * @param  string $path
     * @return string
     */
    protected static function _normalizePath($path)
    {
        return ltrim(preg_replace('#[/\\\\]+#', '/', $path),'/');
    }
}
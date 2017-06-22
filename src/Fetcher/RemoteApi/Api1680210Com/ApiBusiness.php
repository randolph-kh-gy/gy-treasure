<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiBusinessParseException;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiBusinessErrorException;

class ApiBusiness implements ArrayAccess, IteratorAggregate
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiResponse
     */
    protected $apiResponse;

    /**
     * @var mixed
     */
    protected $data;

    /**
     * ApiBusiness constructor.
     * @param  \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiResponse $apiResponse
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiBusinessParseException 无法分析 API 回应
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiBusinessErrorException API 错误
     */
    public function __construct(ApiResponse $apiResponse)
    {
        $this->apiResponse = $apiResponse;

        if (! $this->_isParseable($this->apiResponse->getData())) {
            print_r($this->apiResponse->getData());exit;
            throw new ApiBusinessParseException("Failed to parse the api response.");
        }

        if ($this->apiResponse['businessCode'] != 0) {
            throw new ApiBusinessErrorException($this->apiResponse['message'], $this->apiResponse['businessCode'], $this->apiResponse->getData());
        }

        $this->data = $this->apiResponse['data'];
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->apiResponse['message'];
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * 回传可否被解析
     *
     * @param  mixed  $data
     * @return bool
     */
    protected static function _isParseable($data)
    {
        // 确定是否为阵列
        if (! is_array($data)) {
            return false;
        }

        // 需要有 code, message 及 data 栏位
        if (! isset($data['businessCode']) || ! isset($data['message']) || ! isset($data['data'])) {
            return false;
        }

        return true;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * @param  mixed  $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    /**
     * @param  mixed  $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @return \Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }
}
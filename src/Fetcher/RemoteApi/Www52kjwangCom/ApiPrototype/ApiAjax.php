<?php

namespace GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\ApiPrototype;

use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\ApiRequest;

abstract class ApiAjax
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\ApiRequest
     */
    protected $apiRequest;

    /**
     * ApiAjax constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\ApiRequest $apiRequest
     */
    public function __construct(ApiRequest $apiRequest)
    {
        $this->apiRequest = $apiRequest;
    }

    /**
     * @return string
     */
    abstract protected function apiPath();

    /**
     * @param  string  $ajaxhandler
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function call($ajaxhandler)
    {
        $query = compact('ajaxhandler');
        return $this->apiRequest->call($this->apiPath(), $query);
    }
}
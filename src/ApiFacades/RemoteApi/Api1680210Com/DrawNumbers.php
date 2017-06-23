<?php

namespace GyTreasure\ApiFacades\RemoteApi\Api1680210Com;

use GyTreasure\ApiFacades\Interfaces\ApiCurrentIssue;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCai;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCaiList;

class DrawNumbers implements ApiCurrentIssue
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCai
     */
    protected $apiBaseCQShiCai;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCaiList
     */
    protected $apiBaseCQShiCaiList;

    /**
     * DrawNumbersNum constructor.
     * @param GetBaseCQShiCai $apiBaseCQShiCai
     * @param GetBaseCQShiCaiList $apiBaseCQShiCaiList
     */
    public function __construct(
        GetBaseCQShiCai $apiBaseCQShiCai,
        GetBaseCQShiCaiList $apiBaseCQShiCaiList
    ) {
        $this->apiBaseCQShiCai     = $apiBaseCQShiCai;
        $this->apiBaseCQShiCaiList = $apiBaseCQShiCaiList;
    }

    public static function forge()
    {
        return new static(
            GetBaseCQShiCai::forge(),
            GetBaseCQShiCaiList::forge()
        );
    }

    /**
     * 取得目前的开奖号
     *
     * @param  string  $id
     * @return string|null
     */
    public function currentIssue($id)
    {
        $response = $this->apiBaseCQShiCai->call('', $id);
        return isset($response['drawIssue']) ? $response['drawIssue'] : null;
    }
}
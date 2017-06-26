<?php

namespace GyTreasure\ApiFacades\RemoteApi\Api1680210Com;

use GyTreasure\ApiFacades\Interfaces\ApiCurrentIssue;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCai;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCaiList;

class DrawNumbers implements ApiCurrentIssue, ApiDrawLatestGroupIssues
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
     * DrawNumbers constructor.
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
        return isset($response['preDrawIssue']) ? $response['preDrawIssue'] : null;
    }

    /**
     * 取得最近的开号
     *
     * @param  string  $id
     * @return array
     */
    public function drawLatestGroupIssues($id)
    {
        $response = $this->apiBaseCQShiCaiList->call($id);
        return array_map([$this, '_fetchWinningNumbers'], $response->getData());
    }

    protected function _fetchWinningNumbers(array $data)
    {
        $winningNumbers = explode(',', $data['preDrawCode']);
        $issue = $data['preDrawIssue'];
        return compact('winningNumbers', 'issue');
    }
}
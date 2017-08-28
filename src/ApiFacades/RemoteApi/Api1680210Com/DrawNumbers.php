<?php

namespace GyTreasure\ApiFacades\RemoteApi\Api1680210Com;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiCurrentIssue;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssuesWeakPerformance;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\Factory;

class DrawNumbers implements ApiCurrentIssue, ApiDrawLatestGroupIssues, ApiDrawDateGroupIssuesWeakPerformance
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Factory
     */
    protected $factory;

    /**
     * DrawNumbers constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Factory $factory
     */
    public function __construct(Factory $factory) {
        $this->factory = $factory;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(new Factory());
    }

    /**
     * 取得目前的开奖号.
     *
     * @param  string  $id
     * @return string|null
     */
    public function currentIssue($id)
    {
        $api        = $this->factory->apiInfo($id);
        $response   = $api->call('', $id);
        return isset($response['preDrawIssue']) ? ApiNormalizer::formatIssue($id, $response['preDrawIssue']) : null;
    }

    /**
     * 取得最近的开号.
     *
     * @param  string  $id
     * @return array
     */
    public function drawLatestGroupIssues($id)
    {
        $api        = $this->factory->apiList($id);
        $response   = $api->call($id);
        $data       = array_map([$this, '_fetchWinningNumbers'], $response->getData());

        // 改变期号格式
        array_walk($data, function (&$row) use ($id) {
            $row['issue'] = ApiNormalizer::formatIssue($id, $row['issue']);
        });

        return $data;
    }

    /**
     * 取得指定日期的开号.
     *
     * @param  string  $id
     * @param  \Carbon\Carbon  $date
     * @return array
     */
    public function drawDateGroupIssues($id, Carbon $date)
    {
        $api        = $this->factory->apiList($id);
        $dateString = $date->toDateString();
        $response   = $api->call($id, $dateString);
        $filter     = new ApiDateListFilter();
        $data       = array_map([$this, '_fetchWinningNumbers'], $filter->filter($id, $response->getData(), $date));

        // 改变期号格式
        array_walk($data, function (&$row) use ($id) {
            $row['issue'] = ApiNormalizer::formatIssue($id, $row['issue']);
        });

        return $data;
    }

    /**
     * @param  array  $data
     * @return array
     */
    protected function _fetchWinningNumbers(array $data)
    {
        $winningNumbers = explode(',', $data['preDrawCode']);
        $issue          = $data['preDrawIssue'];
        return compact('winningNumbers', 'issue');
    }
}

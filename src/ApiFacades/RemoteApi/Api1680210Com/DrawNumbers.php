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
        $data       = $this->formatIssues($id, $response->getData());

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
        $data       = $this->formatIssues($id, $filter->filter($id, $response->getData(), $date));

        return $data;
    }

    /**
     * @param  string  $id
     * @param  array   $data
     * @return array
     */
    protected function formatIssues($id, array $data)
    {
        $issues = array_map([$this, '_fetchWinningNumbers'], $data);
        array_walk($issues, function (&$row) use ($id) {
            $row['winningNumbers'] = ApiNormalizer::formatNumbers($id, $row['winningNumbers']);
            $row['issue']          = ApiNormalizer::formatIssue($id, $row['issue']);
        });
        return $issues;
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

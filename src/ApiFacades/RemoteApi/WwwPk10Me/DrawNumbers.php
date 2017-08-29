<?php

namespace GyTreasure\ApiFacades\RemoteApi\WwwPk10Me;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiCurrentIssue;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssuesNum;
use GyTreasure\Fetcher\RemoteApi\WwwPk10Me\Factory;

class DrawNumbers implements ApiCurrentIssue, ApiDrawDateGroupIssues, ApiDrawLatestGroupIssuesNum, ApiDrawLatestGroupIssues
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\WwwPk10Me\Factory
     */
    protected $factory;

    /**
     * DrawNumbers constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\WwwPk10Me\Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(new Factory);
    }

    /**
     * 取得目前的开奖号
     *
     * @param  string  $id
     * @return string|null
     */
    public function currentIssue($id)
    {
        $api    = $this->factory->apiGetData($id);
        $data   = $api->call();
        return $data['periodNumber'];
    }

    /**
     * 取得最近的开号.
     *
     * @param  string  $id
     * @return array
     */
    public function drawLatestGroupIssues($id)
    {
        $api        = $this->factory->historyData($id);
        $response   = $api->call();
        $data       = array_map([$this, '_fetchWinningNumbers'], $response);

        return $data;
    }

    /**
     * 取得最近的开号.
     *
     * @param  string  $id
     * @param  int     $num
     * @return array
     */
    public function drawLatestGroupIssuesNum($id, $num)
    {
        $api        = $this->factory->historyData($id);
        $response   = $api->call($num);
        $data       = array_map([$this, '_fetchWinningNumbers'], $response);

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
        $api        = $this->factory->historyData($id);
        $response   = $api->call(null, $date->toDateString());
        $data       = array_map([$this, '_fetchWinningNumbers'], $response);

        return $data;
    }

    /**
     * @param  array  $data
     * @return array
     */
    protected function _fetchWinningNumbers(array $data)
    {
        $issue          = $data['termNum'];
        $winningNumbers = [];

        $n = 1;
        while (isset($data[$key = 'n' . $n++])) {
            $winningNumbers[] = $data[$key];
        }

        return compact('winningNumbers', 'issue');
    }
}

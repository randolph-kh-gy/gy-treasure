<?php

namespace GyTreasure\ApiFacades\RemoteApi\ChartCp360Cn;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssuesNum;
use GyTreasure\ApiFacades\Interfaces\ApiDrawRangeIssues;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\Factory;

class DrawNumbers implements ApiDrawDateGroupIssues, ApiDrawLatestGroupIssues, ApiDrawLatestGroupIssuesNum, ApiDrawRangeIssues
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\Factory
     */
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory  = $factory;
    }

    /**
     * @return static
     */
    public function forge()
    {
        return new static(new Factory());
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
        $spanType = 2;
        $span     = sprintf('%1$s_%1$s', $date->toDateString());

        $api      = $this->factory->make($id);
        return $api->call($id, $spanType, $span);
    }

    /**
     * 取得最近的开号
     *
     * @param  string  $id
     * @return array
     */
    public function drawLatestGroupIssues($id)
    {
        $api = $this->factory->make($id);
        return $api->call($id);
    }

    /**
     * 取得最近的开号
     *
     * @param  string  $id
     * @param  int     $num
     * @return array
     */
    public function drawLatestGroupIssuesNum($id, $num)
    {
        $spanType = 0;
        $span     = $num;

        $api      = $this->factory->make($id);
        return $api->call($id, $spanType, $span);
    }

    /**
     * 撷取指定范围号码.
     *
     * @param  string  $id
     * @param  string  $from
     * @param  string  $to
     * @return array
     */
    public function drawRangeIssues($id, $from, $to)
    {
        $spanType = 3;
        $span     = $from . '_' . $to;

        $api      = $this->factory->make($id);
        return $api->call($id, $spanType, $span);
    }
}
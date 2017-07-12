<?php

namespace GyTreasure\ApiFacades\RemoteApi\BwlcGovCn;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiFromIssue;
use GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\Factory;

class DrawNumbers implements ApiDrawLatestGroupIssues, ApiFromIssue, ApiDrawDateGroupIssues
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\Prevtrax
     */
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @return static
     */
    public function forge()
    {
        return new static(Prevtrax::forge());
    }

    /**
     * 取得最近的开号.
     *
     * @param  string  $id
     * @return array
     */
    public function drawLatestGroupIssues($id)
    {
        return $this->factory->make($id)->call();
    }

    /**
     * 取得指定日期的开号.
     *
     * @param  string  $id
     * @param  Carbon  $date
     * @return array
     */
    public function drawDateGroupIssues($id, Carbon $date)
    {
        $dateString = $date->toDateString();
        return $this->factory->make($id)->call(null, $dateString);
    }

    /**
     * 撷取指定号码.
     *
     * @param  string  $id
     * @param  string  $issue
     * @return array|null
     */
    public function fromIssue($id, $issue)
    {
        $array = $this->factory->make($id)->call($issue);

        return isset($array[0]['winningNumbers']) ? $array[0]['winningNumbers'] : null;
    }
}
<?php

namespace GyTreasure\ApiFacades\RemoteApi\BwlcGovCn;

use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiFromIssue;
use GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\Prevtrax;

class DrawNumbers implements ApiDrawLatestGroupIssues, ApiFromIssue
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\Prevtrax
     */
    protected $prevtrax;

    public function __construct(Prevtrax $prevtrax)
    {
        $this->prevtrax = $prevtrax;
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
        return $this->prevtrax->call();
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
        $array = $this->prevtrax->call($issue);

        return isset($array[0]['winningNumbers']) ? $array[0]['winningNumbers'] : null;
    }
}
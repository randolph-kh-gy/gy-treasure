<?php

namespace GyTreasure\ApiFacades\RemoteApi\Caipiao163Com;

use GyTreasure\ApiFacades\Interfaces\ApiHallIssues;
use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\Index;

class IssueHall implements ApiHallIssues
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\Index
     */
    protected $api;

    /**
     * IssueHall constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\Index $api
     */
    public function __construct(Index $api)
    {
        $this->api = $api;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(Index::forge());
    }

    /**
     * @return array
     */
    public function getHallIssues()
    {
        return $this->api->call();
    }
}
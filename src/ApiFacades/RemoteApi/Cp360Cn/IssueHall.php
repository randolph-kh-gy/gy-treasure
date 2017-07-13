<?php

namespace GyTreasure\ApiFacades\RemoteApi\Cp360Cn;

use GyTreasure\ApiFacades\Interfaces\ApiHallIssues;
use GyTreasure\Fetcher\RemoteApi\Cp360Cn\Kj\Kaijiang;

class IssueHall implements ApiHallIssues
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Cp360Cn\Kj\Kaijiang
     */
    protected $api;

    /**
     * IssueHall constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Cp360Cn\Kj\Kaijiang $api
     */
    public function __construct(Kaijiang $api)
    {
        $this->api = $api;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(Kaijiang::forge());
    }

    /**
     * @return array
     */
    public function getHallIssues()
    {
        return $this->api->call();
    }
}
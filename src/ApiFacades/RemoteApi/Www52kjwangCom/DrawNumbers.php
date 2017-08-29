<?php

namespace GyTreasure\ApiFacades\RemoteApi\Www52kjwangCom;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiCurrentIssue;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Factory;

class DrawNumbers implements ApiCurrentIssue, ApiDrawDateGroupIssues
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Factory
     */
    protected $factory;

    /**
     * DrawNumbers constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Factory $factory
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
        return new static(new Factory());
    }

    /**
     * 取得目前的开奖号
     *
     * @param  string  $id
     * @return string|null
     */
    public function currentIssue($id)
    {
        $api    = $this->factory->apiAjax($id);
        $data   = $api->call('GetPk10AwardData');

        if (isset($data['current']['periodNumber'])) {
            return (string) $data['current']['periodNumber'];
        }
        return null;
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
        $api = $this->factory->apiGetList($id);
        return $api->call($date->toDateString());
    }
}

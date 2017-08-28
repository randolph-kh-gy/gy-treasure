<?php

namespace GyTreasure\ApiFacades\RemoteApi\WwwPk10Me;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\Fetcher\RemoteApi\WwwPk10Me\Factory;

class DrawNumbers implements ApiDrawDateGroupIssues
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
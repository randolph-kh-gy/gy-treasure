<?php

namespace GyTreasure\ApiFacades\RemoteApi\Kaijiang500Com;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Factory;

class DrawNumbers implements ApiDrawDateGroupIssues
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Factory
     */
    protected $factory;

    /**
     * DrawNumbers constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Factory $factory
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
     * 取得指定日期的开号.
     *
     * @param  string  $id
     * @param  \Carbon\Carbon  $date
     * @return array
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException 無法取得 API
     * @throws \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException 无法分析 API 回应
     */
    public function drawDateGroupIssues($id, Carbon $date)
    {
        $api  = $this->factory->make($id);
        $data = $api->call($id, $date->toDateString());
        return $this->formatRows($id, $data);
    }

    /**
     * @param  string  $id
     * @param  array   $rows
     * @return array
     */
    protected function formatRows($id, array $rows)
    {
        $returnArray = [];
        foreach ($rows as $row) {
            $returnArray[] = [
                'winningNumbers' => $row['opencode'],
                'issue'          => ApiNormalizer::formatIssue($id, $row['expect']),
            ];
        }
        return $returnArray;
    }
}

<?php

namespace GyTreasure\Process\DrawAllToday\Strategies;

use GyTreasure\Process\ApiStrategy;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssuesNum;

class ApiDrawLatestGroupIssuesNumStrategy extends ApiStrategy
{
    /**
     * @return array
     */
    public function getIssues()
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawLatestGroupIssuesNum::class];
        $next = null;

        return $this->call($api, function ($instance, $info) {

            return $instance->drawLatestGroupIssuesNum($info['id'], 10);

        }, $next);
    }
}
<?php

namespace GyTreasure\Process\DrawAllToday\Strategies;

use GyTreasure\Process\ApiStrategy;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues;

class ApiDrawLatestGroupIssuesStrategy extends ApiStrategy
{
    /**
     * @return array
     */
    public function getIssues()
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawLatestGroupIssues::class];
        $next = [ApiDrawLatestGroupIssuesNumStrategy::class, 'getIssues'];

        return $this->call($api, function ($instance, $info) {

            return $instance->drawLatestGroupIssues($info['id']);

        }, $next);
    }
}
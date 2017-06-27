<?php

namespace GyTreasure\Process\DrawAllToday\Strategies;

use GyTreasure\Process\ApiStrategy;

class ApiDrawLatestGroupIssuesNumStrategy extends ApiStrategy
{
    /**
     * @return array
     */
    public function getIssues()
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'interface' => 'ApiDrawLatestGroupIssuesNum'];
        $next = null;

        return $this->call($api, function ($instance, $info) {

            return $instance->drawLatestGroupIssuesNum($info['id'], 10);

        }, $next);
    }
}
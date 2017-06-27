<?php

namespace GyTreasure\Process\DrawAllToday\Strategies;

use GyTreasure\Process\ApiStrategy;

class ApiDrawLatestGroupIssuesStrategy extends ApiStrategy
{
    /**
     * @return array
     */
    public function getIssues()
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'interface' => 'ApiDrawLatestGroupIssues'];
        $next = [ApiDrawLatestGroupIssuesNumStrategy::class, 'getIssues'];

        return $this->call($api, function ($instance, $info) {

            return $instance->drawLatestGroupIssues($info['id']);

        }, $next);
    }
}
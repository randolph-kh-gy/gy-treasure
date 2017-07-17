<?php

namespace GyTreasure\Process\DrawDate\Strategies;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\Process\ApiStrategy;

class ApiDrawDateGroupIssuesStrategy extends ApiStrategy
{
    /**
     * @param  \Carbon\Carbon  $date
     * @param  array           $expects
     * @return array|null
     */
    public function getIssues(Carbon $date, array $expects)
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawDateGroupIssues::class];
        $next = null;

        return $this->call($api, function (ApiDrawDateGroupIssues $instance, $info) use ($date) {

            return $instance->drawDateGroupIssues($info['id'], $date);

        }, $next);

        // TODO $expects 未接上
    }
}

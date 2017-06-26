<?php

namespace GyTreasure\Process\DrawAllToday\Strategies;

use GyTreasure\Process\ApiStrategy;

class ApiDrawLatestGroupIssuesNumStrategy extends ApiStrategy
{
    /**
     * @param  string  $id
     * @return array
     */
    public function getIssues($id)
    {
        /**
         * @var \GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssuesNum|null
         */
        $instance = $this->getApiInstance('DrawNumbers', 'forge', 'ApiDrawLatestGroupIssuesNum');

        if ($instance) {
            return $instance->drawLatestGroupIssuesNum($id, 10);
        }

        return [];
    }
}
<?php

namespace GyTreasure\Process\DrawAllToday\Strategies;

use GyTreasure\Process\ApiStrategy;

class ApiDrawLatestGroupIssuesStrategy extends ApiStrategy
{
    /**
     * @param  string  $id
     * @return array
     */
    public function getIssues($id)
    {
        /**
         * @var \GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues|null
         */
        $instance = $this->getApiInstance('DrawNumbers', 'forge', 'ApiDrawLatestGroupIssues');

        if (! $instance) {

            $next = new ApiDrawLatestGroupIssuesNumStrategy($this->process());
            $this->process->setStrategy($next);
            return $next->getIssues($id);
        }

        return $instance->drawLatestGroupIssues($id);
    }
}
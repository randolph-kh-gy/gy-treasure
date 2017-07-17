<?php

namespace GyTreasure\Issue;

use Carbon\Carbon;

class QuickIssue
{
    /**
     * @param  string  $id
     * @param  \Carbon\Carbon $date
     * @return array|null
     */
    public function generate($id, Carbon $date)
    {
        $config = IssueInfoConfig::get($id);
        if (! $config) {
            return null;
        }

        $generator = GeneratorFactory::make('legacy', $config);
        $generator->setDateRange($date, $date);
        return $generator->getArray();
    }
}

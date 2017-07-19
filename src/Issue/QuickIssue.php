<?php

namespace GyTreasure\Issue;

use Carbon\Carbon;

class QuickIssue
{
    /**
     * @param  string  $id
     * @param  \Carbon\Carbon  $date
     * @param  int     $startNumber
     * @param  bool    $numbersOnly
     * @return array|null
     */
    public function generate($id, Carbon $date, $startNumber = 1, $numbersOnly = false)
    {
        $config = IssueInfoConfig::get($id);
        if (! $config) {
            return null;
        }

        $generator = GeneratorFactory::make('legacy', $config, $startNumber);
        $generator->setDateRange($date, $date);
        return $generator->getArray($numbersOnly);
    }
}

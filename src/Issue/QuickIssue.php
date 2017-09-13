<?php

namespace GyTreasure\Issue;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueRules;

class QuickIssue
{
    /**
     * @param  string  $id
     * @param  \Carbon\Carbon  $date
     * @param  int     $startNumber
     * @param  bool    $numbersOnly
     * @return \Generator
     */
    public function generate($id, Carbon $date, $startNumber = 1, $numbersOnly = false)
    {
        $config = IssueInfoConfig::get($id);
        if ($config) {
            $generator = GeneratorFactory::make('default', $id, $config, $startNumber);
            $generator->setDateRange($date, $date);

            foreach ($generator->run($numbersOnly) as $row) {
                yield $row;
            }
        }
    }

    /**
     * @param  string  $id
     * @return \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueRules|null
     */
    public function getIssueRules($id)
    {
        $config = IssueInfoConfig::get($id);
        if (! $config) {
            return null;
        }

        return new IssueRules($config['issuerule']);
    }
}

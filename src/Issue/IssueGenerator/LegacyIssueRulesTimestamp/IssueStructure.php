<?php

namespace GyTreasure\Issue\IssueGenerator\LegacyIssueRulesTimestamp;

use GyTreasure\Issue\IssueStructure as BaseIssueStructure;

class IssueStructure extends BaseIssueStructure
{
    /**
     * @var string
     */
    public $issueRule;

    /**
     * @var array
     */
    public $issueSet;

    /**
     * @var int
     */
    public $startNumber;

    /**
     * @param  string  $issueRule
     * @param  array   $issueSet
     * @param  int     $startNumber
     * @return static
     */
    public static function make($issueRule, array $issueSet, $startNumber = 1)
    {
        $structure = new static();
        $structure->issueRule   = $issueRule;
        $structure->issueSet    = $issueSet;
        $structure->startNumber = $startNumber;
        return $structure;
    }
}

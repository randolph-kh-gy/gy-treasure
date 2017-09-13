<?php

namespace GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator;

use GyTreasure\Issue\IssueStructure as BaseIssueStructure;

class ScriptIssueStructure extends BaseIssueStructure
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var int
     */
    public $startNumber;

    /**
     * @param  string  $id
     * @param  int     $startNumber
     * @return static
     */
    public static function make($id, $startNumber = 1)
    {
        $structure = new static();
        $structure->id   = $id;
        $structure->startNumber = $startNumber;
        return $structure;
    }
}

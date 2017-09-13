<?php

namespace GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\Scripts;

use Carbon\Carbon;

interface IssueGenerationScript
{
    /**
     * @param  \Carbon\Carbon  $date
     * @param  int  $number
     * @return \Generator
     */
    public function generate(Carbon $date, &$number = 0);
}
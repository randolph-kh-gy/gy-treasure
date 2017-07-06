<?php

namespace Tests\Unit\Issue\IssueGenerator\LegacyIssueRules;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueRulesFormatter;
use PHPUnit\Framework\TestCase;

class IssueRulesFormatterTest extends TestCase
{
    public function testReplaceYMD()
    {
        $format = '159[Ymd]784';
        $date   = Carbon::create(2017, 3, 3);

        $returnValue = IssueRulesFormatter::replaceYMD($format, $date);

        $this->assertEquals('159[20170303]784', $returnValue);
    }

    public function testReplaceNo()
    {
        $format = '157[n3]112';
        $number = 81;

        $returnValue = IssueRulesFormatter::replaceNo($format, $number);

        $this->assertEquals('157081112', $returnValue);
    }
}

<?php

namespace Tests\Unit\Issue\IssueGenerator\LegacyIssueRules;

use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueRules;
use PHPUnit\Framework\TestCase;

class IssueRulesTest extends TestCase
{
    /**
     * @expectedException \GyTreasure\Issue\IssueGenerator\Exceptions\LegacyIssueRulesParsingException
     */
    public function testLegacyIssueRulesParsingException()
    {
        $invalidIssueRule = 'bkj2130zYmdn3';
        new IssueRules($invalidIssueRule);
    }

    public function testCreate()
    {
        // 同时测试 toArray 函式

        $string  = 'Ymd[n3]|0,0,1';
        $rule    = new IssueRules($string);
        $expects = ['format' => 'Ymd[n3]', 'resetWhen' => ['year' => true, 'month' => true, 'day' => false]];

        $this->assertEquals($expects, $rule->toArray());

        // 测试月
        $string  = 'Ym[n5]|0,1,0';
        $rule    = new IssueRules($string);
        $expects = ['format' => 'Ym[n5]', 'resetWhen' => ['year' => true, 'month' => false, 'day' => true]];

        $this->assertEquals($expects, $rule->toArray());

        // 测试年
        $string  = 'Y[n8]|1,0,0';
        $rule    = new IssueRules($string);
        $expects = ['format' => 'Y[n8]', 'resetWhen' => ['year' => false, 'month' => true, 'day' => true]];

        $this->assertEquals($expects, $rule->toArray());
    }

    public function testGetNumberFromIssue()
    {
        $string  = 'Ymd[n3]|0,0,1';
        $rule    = new IssueRules($string);

        $issue   = '20170621-056';
        $expects = 56;

        $returnValue = $rule->getNumberFromIssue($issue);
        $this->assertSame($expects, $returnValue);
    }

    public function testGuessingNumberWithDash()
    {
        $issue       = '20170621-056';
        $expects     = 56;
        $returnValue = IssueRules::guessingNumberWithDash($issue);

        $this->assertSame($expects, $returnValue);
    }

    public function testGuessingNumberWithDate()
    {
        $issue       = '20170621056';
        $expects     = 56;
        $returnValue = IssueRules::guessingNumberWithDate($issue);

        $this->assertSame($expects, $returnValue);

        $issue       = '201700156';
        $expects     = 156;
        $returnValue = IssueRules::guessingNumberWithDate($issue);

        $this->assertSame($expects, $returnValue);
    }
}

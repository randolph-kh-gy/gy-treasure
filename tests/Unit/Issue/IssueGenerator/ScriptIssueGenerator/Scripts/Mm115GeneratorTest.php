<?php

namespace Tests\Unit\Issue\IssueGenerator\ScriptIssueGenerator\Scripts;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\Scripts\Mm115Generator;

class Mm115GeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $date      = new Carbon('2017-09-12');

        $generator = new Mm115Generator();
        $result    = iterator_to_array($generator->generate($date));

        $this->assertEquals(2641, count($result));

        $firstIssue = $result[0];
        $this->assertEquals('20170912-0001', $firstIssue['issue']);
        $this->assertEquals('2017-09-12', $firstIssue['belongdate']);
        $this->assertEquals(new Carbon('2017-09-12 00:00:45'), $firstIssue['salestart']);
        $this->assertEquals(new Carbon('2017-09-12 00:00:45'), $firstIssue['saleend']);
        $this->assertEquals(new Carbon('2017-09-12 00:00:45'), $firstIssue['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-12 00:00:45'), $firstIssue['earliestwritetime']);

        $secondIssue = $result[1];
        $this->assertEquals('20170912-0002', $secondIssue['issue']);
        $this->assertEquals('2017-09-12', $secondIssue['belongdate']);
        $this->assertEquals(new Carbon('2017-09-12 00:00:45'), $secondIssue['salestart']);
        $this->assertEquals(new Carbon('2017-09-12 00:01:15'), $secondIssue['saleend']);
        $this->assertEquals(new Carbon('2017-09-12 00:01:15'), $secondIssue['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-12 00:01:15'), $secondIssue['earliestwritetime']);

        $issue601    = $result[600];
        $this->assertEquals('20170912-0601', $issue601['issue']);
        $this->assertEquals('2017-09-12', $issue601['belongdate']);
        $this->assertEquals(new Carbon('2017-09-12 05:00:15'), $issue601['salestart']);
        $this->assertEquals(new Carbon('2017-09-12 05:00:45'), $issue601['saleend']);
        $this->assertEquals(new Carbon('2017-09-12 05:00:45'), $issue601['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-12 05:00:45'), $issue601['earliestwritetime']);

        $issue602    = $result[601];
        $this->assertEquals('20170912-0602', $issue602['issue']);
        $this->assertEquals('2017-09-12', $issue602['belongdate']);
        $this->assertEquals(new Carbon('2017-09-12 07:00:15'), $issue602['salestart']);
        $this->assertEquals(new Carbon('2017-09-12 07:00:45'), $issue602['saleend']);
        $this->assertEquals(new Carbon('2017-09-12 07:00:45'), $issue602['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-12 07:00:45'), $issue602['earliestwritetime']);

        $lastIssue   = $result[2640];
        $this->assertEquals('20170912-2641', $lastIssue['issue']);
        $this->assertEquals('2017-09-12', $lastIssue['belongdate']);
        $this->assertEquals(new Carbon('2017-09-12 23:59:45'), $lastIssue['salestart']);
        $this->assertEquals(new Carbon('2017-09-13 00:00:15'), $lastIssue['saleend']);
        $this->assertEquals(new Carbon('2017-09-13 00:00:15'), $lastIssue['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-13 00:00:15'), $lastIssue['earliestwritetime']);
    }
}

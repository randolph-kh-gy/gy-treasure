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
        $result    = $generator->generate($date);

        $this->assertEquals(2641, count($result));

        $firstDay  = $result[0];
        $this->assertEquals('20170912-0001', $firstDay['issue']);
        $this->assertEquals('2017-09-12', $firstDay['belongdate']);
        $this->assertEquals(new Carbon('2017-09-12 00:00:45'), $firstDay['salestart']);
        $this->assertEquals(new Carbon('2017-09-12 00:00:45'), $firstDay['saleend']);
        $this->assertEquals(new Carbon('2017-09-12 00:00:45'), $firstDay['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-12 00:00:45'), $firstDay['earliestwritetime']);
    }
}

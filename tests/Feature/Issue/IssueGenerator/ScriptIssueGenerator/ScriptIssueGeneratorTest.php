<?php

namespace Tests\Feature\Issue\IssueGenerator\ScriptIssueGenerator;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\ScriptIssueGenerator;

class ScriptIssueGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testMm115()
    {
        $id        = 'miaomiao115';
        $start     = new Carbon('2017-09-13');
        $end       = new Carbon('2017-09-14');

        $generator = new ScriptIssueGenerator($id);
        $generator->setDateRange($start, $end);

        $result    = $generator->getArray();

        $this->assertEquals(5282, count($result));

        $day1First = $result[0];
        $this->assertEquals('20170913-0001', $day1First['issue']);
        $this->assertEquals('2017-09-13', $day1First['belongdate']);
        $this->assertEquals(new Carbon('2017-09-13 00:00:45'), $day1First['salestart']);
        $this->assertEquals(new Carbon('2017-09-13 00:00:45'), $day1First['saleend']);
        $this->assertEquals(new Carbon('2017-09-13 00:00:45'), $day1First['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-13 00:00:45'), $day1First['earliestwritetime']);

        $day1Second = $result[1];
        $this->assertEquals('20170913-0002', $day1Second['issue']);
        $this->assertEquals('2017-09-13', $day1Second['belongdate']);
        $this->assertEquals(new Carbon('2017-09-13 00:00:45'), $day1Second['salestart']);
        $this->assertEquals(new Carbon('2017-09-13 00:01:15'), $day1Second['saleend']);
        $this->assertEquals(new Carbon('2017-09-13 00:01:15'), $day1Second['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-13 00:01:15'), $day1Second['earliestwritetime']);

        $day1Issue601 = $result[600];
        $this->assertEquals('20170913-0601', $day1Issue601['issue']);
        $this->assertEquals('2017-09-13', $day1Issue601['belongdate']);
        $this->assertEquals(new Carbon('2017-09-13 05:00:15'), $day1Issue601['salestart']);
        $this->assertEquals(new Carbon('2017-09-13 05:00:45'), $day1Issue601['saleend']);
        $this->assertEquals(new Carbon('2017-09-13 05:00:45'), $day1Issue601['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-13 05:00:45'), $day1Issue601['earliestwritetime']);

        $day1Issue602 = $result[601];
        $this->assertEquals('20170913-0602', $day1Issue602['issue']);
        $this->assertEquals('2017-09-13', $day1Issue602['belongdate']);
        $this->assertEquals(new Carbon('2017-09-13 07:00:15'), $day1Issue602['salestart']);
        $this->assertEquals(new Carbon('2017-09-13 07:00:45'), $day1Issue602['saleend']);
        $this->assertEquals(new Carbon('2017-09-13 07:00:45'), $day1Issue602['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-13 07:00:45'), $day1Issue602['earliestwritetime']);

        $day1Last = $result[2640];
        $this->assertEquals('20170913-2641', $day1Last['issue']);
        $this->assertEquals('2017-09-13', $day1Last['belongdate']);
        $this->assertEquals(new Carbon('2017-09-13 23:59:45'), $day1Last['salestart']);
        $this->assertEquals(new Carbon('2017-09-14 00:00:15'), $day1Last['saleend']);
        $this->assertEquals(new Carbon('2017-09-14 00:00:15'), $day1Last['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-14 00:00:15'), $day1Last['earliestwritetime']);

        $day2First = $result[2641];
        $this->assertEquals('20170914-0001', $day2First['issue']);
        $this->assertEquals('2017-09-14', $day2First['belongdate']);
        $this->assertEquals(new Carbon('2017-09-14 00:00:45'), $day2First['salestart']);
        $this->assertEquals(new Carbon('2017-09-14 00:00:45'), $day2First['saleend']);
        $this->assertEquals(new Carbon('2017-09-14 00:00:45'), $day2First['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-14 00:00:45'), $day2First['earliestwritetime']);

        $day2Second = $result[2642];
        $this->assertEquals('20170914-0002', $day2Second['issue']);
        $this->assertEquals('2017-09-14', $day2Second['belongdate']);
        $this->assertEquals(new Carbon('2017-09-14 00:00:45'), $day2Second['salestart']);
        $this->assertEquals(new Carbon('2017-09-14 00:01:15'), $day2Second['saleend']);
        $this->assertEquals(new Carbon('2017-09-14 00:01:15'), $day2Second['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-14 00:01:15'), $day2Second['earliestwritetime']);

        $day2Issue601 = $result[3241];
        $this->assertEquals('20170914-0601', $day2Issue601['issue']);
        $this->assertEquals('2017-09-14', $day2Issue601['belongdate']);
        $this->assertEquals(new Carbon('2017-09-14 05:00:15'), $day2Issue601['salestart']);
        $this->assertEquals(new Carbon('2017-09-14 05:00:45'), $day2Issue601['saleend']);
        $this->assertEquals(new Carbon('2017-09-14 05:00:45'), $day2Issue601['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-14 05:00:45'), $day2Issue601['earliestwritetime']);

        $day2Issue602 = $result[3242];
        $this->assertEquals('20170914-0602', $day2Issue602['issue']);
        $this->assertEquals('2017-09-14', $day2Issue602['belongdate']);
        $this->assertEquals(new Carbon('2017-09-14 07:00:15'), $day2Issue602['salestart']);
        $this->assertEquals(new Carbon('2017-09-14 07:00:45'), $day2Issue602['saleend']);
        $this->assertEquals(new Carbon('2017-09-14 07:00:45'), $day2Issue602['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-14 07:00:45'), $day2Issue602['earliestwritetime']);

        $day2Last = $result[5281];
        $this->assertEquals('20170914-2641', $day2Last['issue']);
        $this->assertEquals('2017-09-14', $day2Last['belongdate']);
        $this->assertEquals(new Carbon('2017-09-14 23:59:45'), $day2Last['salestart']);
        $this->assertEquals(new Carbon('2017-09-15 00:00:15'), $day2Last['saleend']);
        $this->assertEquals(new Carbon('2017-09-15 00:00:15'), $day2Last['canneldeadline']);
        $this->assertEquals(new Carbon('2017-09-15 00:00:15'), $day2Last['earliestwritetime']);
    }
}

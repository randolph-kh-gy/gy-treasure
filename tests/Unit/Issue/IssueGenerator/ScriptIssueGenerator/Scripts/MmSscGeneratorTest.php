<?php

namespace Tests\Unit\Issue\IssueGenerator\ScriptIssueGenerator\Scripts;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\Scripts\MmSscGenerator;

class MmSscGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $date = new Carbon('2017-10-06');

        $generator = new MmSscGenerator();
        $result = iterator_to_array($generator->generate($date));

        $this->assertEquals(2638, count($result));

        $firstIssue = $result[0];
        $this->assertEquals('20171006-0001', $firstIssue['issue']);
        $this->assertEquals('2017-10-06', $firstIssue['belongdate']);
        $this->assertEquals(new Carbon('2017-10-06 00:00:55'), $firstIssue['salestart']);
        $this->assertEquals(new Carbon('2017-10-06 00:01:25'), $firstIssue['saleend']);
        $this->assertEquals(new Carbon('2017-10-06 00:01:25'), $firstIssue['canneldeadline']);
        $this->assertEquals(new Carbon('2017-10-06 00:01:25'), $firstIssue['earliestwritetime']);

        $secondIssue = $result[1];
        $this->assertEquals('20171006-0002', $secondIssue['issue']);
        $this->assertEquals('2017-10-06', $secondIssue['belongdate']);
        $this->assertEquals(new Carbon('2017-10-06 00:01:25'), $secondIssue['salestart']);
        $this->assertEquals(new Carbon('2017-10-06 00:01:55'), $secondIssue['saleend']);
        $this->assertEquals(new Carbon('2017-10-06 00:01:55'), $secondIssue['canneldeadline']);
        $this->assertEquals(new Carbon('2017-10-06 00:01:55'), $secondIssue['earliestwritetime']);

        $issue599    = $result[598];
        $this->assertEquals('20171006-0599', $issue599['issue']);
        $this->assertEquals('2017-10-06', $issue599['belongdate']);
        $this->assertEquals(new Carbon('2017-10-06 04:59:55'), $issue599['salestart']);
        $this->assertEquals(new Carbon('2017-10-06 05:00:25'), $issue599['saleend']);
        $this->assertEquals(new Carbon('2017-10-06 05:00:25'), $issue599['canneldeadline']);
        $this->assertEquals(new Carbon('2017-10-06 05:00:25'), $issue599['earliestwritetime']);

        $issue600    = $result[599];
        $this->assertEquals('20171006-0600', $issue600['issue']);
        $this->assertEquals('2017-10-06', $issue600['belongdate']);
        $this->assertEquals(new Carbon('2017-10-06 07:00:55'), $issue600['salestart']);
        $this->assertEquals(new Carbon('2017-10-06 07:01:25'), $issue600['saleend']);
        $this->assertEquals(new Carbon('2017-10-06 07:01:25'), $issue600['canneldeadline']);
        $this->assertEquals(new Carbon('2017-10-06 07:01:25'), $issue600['earliestwritetime']);

        $lastIssue   = $result[2637];
        $this->assertEquals('20171006-2638', $lastIssue['issue']);
        $this->assertEquals('2017-10-06', $lastIssue['belongdate']);
        $this->assertEquals(new Carbon('2017-10-06 23:59:55'), $lastIssue['salestart']);
        $this->assertEquals(new Carbon('2017-10-07 00:00:25'), $lastIssue['saleend']);
        $this->assertEquals(new Carbon('2017-10-07 00:00:25'), $lastIssue['canneldeadline']);
        $this->assertEquals(new Carbon('2017-10-07 00:00:25'), $lastIssue['earliestwritetime']);
    }
}

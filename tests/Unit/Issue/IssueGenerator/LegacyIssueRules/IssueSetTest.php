<?php

namespace Tests\Unit\Issue\IssueGenerator\LegacyIssueRules;

use PHPUnit\Framework\TestCase;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\IssueDateTime;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSet;

class IssueSetTest extends TestCase
{
    public function testCreateTestCase1()
    {
        $setting = [
            'starttime'     => '01:02:03',
            'endtime'       => '04:05:06',
            'firstendtime'  => '07:08:09',
            'cycle'         => 300,
            'endsale'       => 1,
            'inputcodetime' => 2,
            'droptime'      => 3,
            'status'        => true,
            'sort'          => 134,
        ];

        $issueset = new IssueSet($setting);

        $expects = [
            'starttime'     => [1, 2, 3],
            'endtime'       => [4, 5, 6],
            'firstendtime'  => [7, 8, 9],
            'cycle'         => 300,
            'endsale'       => 1,
            'inputcodetime' => 2,
            'droptime'      => 3,
            'status'        => true,
            'sort'          => 134,
        ];

        $actual = [
            'starttime'     => $issueset->get('starttime'),
            'endtime'       => $issueset->get('endtime'),
            'firstendtime'  => $issueset->get('firstendtime'),
            'cycle'         => $issueset->get('cycle'),
            'endsale'       => $issueset->get('endsale'),
            'inputcodetime' => $issueset->get('inputcodetime'),
            'droptime'      => $issueset->get('droptime'),
            'status'        => $issueset->get('status'),
            'sort'          => $issueset->get('sort'),
        ];

        $this->assertSame($expects, $actual);
    }

    /**
     * @expectedException \Exception
     */
    public function testCreateTestCase2()
    {
        $setting = [];
        new IssueSet($setting);
    }

    public function testApplyFirstTime()
    {
        $date     = Carbon::today();
        $expects  = Carbon::today()->setTime(11, 22, 33);

        $setting  = ['starttime' => '11:22:33', 'cycle' => 300];
        $issueset = new IssueSet($setting);

        $issueset->applyFirstTime($date);

        $this->assertEquals($expects, $date);
    }

    public function testGetRangeCase1()
    {
        $date        = Carbon::create(2017, 7, 5, 0, 0, 0);
        $starttime   = Carbon::create(2017, 7, 5, 22, 10, 40);
        $endtime     = Carbon::create(2017, 7, 5, 23, 59, 59);
        $expects     = compact('starttime', 'endtime');

        $setting     = ['starttime' => '22:10:40', 'endtime' => '23:59:59', 'cycle' => 300];
        $issueset    = new IssueSet($setting);

        $returnArray = $issueset->getRange($date);

        $this->assertEquals($expects, $returnArray);

        // 原值 $date 不应该被变动
        $this->assertEquals(Carbon::create(2017, 7, 5, 0, 0, 0), $date);
    }

    public function testGetRangeCase2()
    {
        $date        = Carbon::create(2017, 7, 5, 0, 0, 0);
        $starttime   = Carbon::create(2017, 7, 5, 22, 10, 40);
        $endtime     = Carbon::create(2017, 7, 6, 0, 0, 0);
        $expects     = compact('starttime', 'endtime');

        $setting     = ['starttime' => '22:10:40', 'endtime' => '00:00:00', 'cycle' => 300];
        $issueset    = new IssueSet($setting);

        $returnArray = $issueset->getRange($date);

        $this->assertEquals($expects, $returnArray);
    }

    public function testNextCycle()
    {
        $date        = new IssueDateTime(Carbon::create(2017, 7, 5, 0, 0, 0));
        $starttime   = Carbon::create(2017, 7, 5, 22, 10, 20);

        $date->dateTime = $starttime;

        $setting     = ['starttime' => '22:10:20', 'endtime' => '22:22:30', 'firstendtime' => '22:12:30', 'cycle' => 300];
        $issueset    = new IssueSet($setting);

        $returnIssueDateTime = $issueset->nextCycle($date);
        $this->assertNotEquals($date, $returnIssueDateTime);
        $this->assertEquals(Carbon::create(2017, 7, 5, 22, 12, 30), $returnIssueDateTime->dateTime);

        $returnIssueDateTime = $issueset->nextCycle($returnIssueDateTime);
        $this->assertEquals(Carbon::create(2017, 7, 5, 22, 17, 30), $returnIssueDateTime->dateTime);

        $returnIssueDateTime = $issueset->nextCycle($returnIssueDateTime);
        $this->assertEquals(Carbon::create(2017, 7, 5, 22, 22, 30), $returnIssueDateTime->dateTime);

        $returnIssueDateTime = $issueset->nextCycle($returnIssueDateTime);
        $this->assertNull($returnIssueDateTime);
    }

    public function testIsAvailable()
    {
        $setting  = ['status' => 0, 'cycle' => 300];
        $issueset = new IssueSet($setting);

        $this->assertFalse($issueset->isAvailable());

        $setting  = ['status' => 1, 'cycle' => 300];
        $issueset = new IssueSet($setting);

        $this->assertTrue($issueset->isAvailable());
    }

    public function testIssueDateTimeInfo()
    {
        $setting = [
            'starttime'     => '01:00:00',
            'endtime'       => '02:00:00',
            'firstendtime'  => '01:10:00',
            'cycle'         => 300,
            'endsale'       => 10,
            'inputcodetime' => 20,
            'droptime'      => 30,
            'status'        => true,
            'sort'          => 1,
        ];

        $issueset = new IssueSet($setting);

        $date = new IssueDateTime(Carbon::create(2017, 7, 5, 0, 0, 0));
        $date->dateTime = Carbon::create(2017, 7, 5, 1, 15, 0);

        $returnArray = $issueset->issueDateTimeInfo($date);

        $expects = [
            'belongdate'        => '2017-07-05',
            'salestart'         => Carbon::create(2017, 7, 5, 1, 9, 50),
            'saleend'           => Carbon::create(2017, 7, 5, 1, 14, 50),
            'canneldeadline'    => Carbon::create(2017, 7, 5, 1, 14, 30),
            'earliestwritetime' => Carbon::create(2017, 7, 5, 1, 15, 20),
        ];

        $this->assertEquals($expects, $returnArray);
    }
}
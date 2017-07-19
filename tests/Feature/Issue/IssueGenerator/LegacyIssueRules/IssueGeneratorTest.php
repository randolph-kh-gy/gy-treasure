<?php

namespace Tests\Feature\Issue\IssueGenerator\LegacyIssueRules;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueGenerator;
use GyTreasure\Issue\IssueInfoConfig;
use PHPUnit\Framework\TestCase;

class IssueGeneratorTest extends TestCase
{
    /**
     * 重庆时时彩奖期产生测试
     */
    public function testSscCase()
    {
        $start  = Carbon::create(2017, 7, 6);
        $end    = Carbon::create(2017, 7, 7);

        $config = IssueInfoConfig::get('chongqing_ssc');

        $generator = IssueGenerator::forge($config['issuerule'], $config['issueset']);
        $generator->setDateRange($start, $end);

        $result = $generator->getArray();

        $this->assertEquals(240, count($result));

        $day1First = $result[0];
        $this->assertEquals('20170706-001', $day1First['issue']);
        $this->assertEquals('2017-07-06', $day1First['belongdate']);
        $this->assertEquals(new Carbon('2017-07-05 23:59:25'), $day1First['salestart']);
        $this->assertEquals(new Carbon('2017-07-06 00:04:25'), $day1First['saleend']);
        $this->assertEquals(new Carbon('2017-07-06 00:04:25'), $day1First['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-06 00:05:30'), $day1First['earliestwritetime']);

        $day1Last = $result[119];
        $this->assertEquals('20170706-120', $day1Last['issue']);
        $this->assertEquals('2017-07-06', $day1Last['belongdate']);
        $this->assertEquals(new Carbon('2017-07-06 23:54:25'), $day1Last['salestart']);
        $this->assertEquals(new Carbon('2017-07-06 23:59:25'), $day1Last['saleend']);
        $this->assertEquals(new Carbon('2017-07-06 23:59:25'), $day1Last['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-07 00:00:30'), $day1Last['earliestwritetime']);

        $day2First = $result[120];
        $this->assertEquals('20170707-001', $day2First['issue']);
        $this->assertEquals('2017-07-07', $day2First['belongdate']);
        $this->assertEquals(new Carbon('2017-07-06 23:59:25'), $day2First['salestart']);
        $this->assertEquals(new Carbon('2017-07-07 00:04:25'), $day2First['saleend']);
        $this->assertEquals(new Carbon('2017-07-07 00:04:25'), $day2First['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-07 00:05:30'), $day2First['earliestwritetime']);

        $day2Last = $result[239];
        $this->assertEquals('20170707-120', $day2Last['issue']);
        $this->assertEquals('2017-07-07', $day2Last['belongdate']);
        $this->assertEquals(new Carbon('2017-07-07 23:54:25'), $day2Last['salestart']);
        $this->assertEquals(new Carbon('2017-07-07 23:59:25'), $day2Last['saleend']);
        $this->assertEquals(new Carbon('2017-07-07 23:59:25'), $day2Last['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-08 00:00:30'), $day2Last['earliestwritetime']);
    }

    /**
     * 福彩3D奖期产生测试
     */
    public function testFc3DCase()
    {
        $start = Carbon::create(2017, 3, 29);
        $end   = Carbon::create(2017, 7, 6);

        $config = IssueInfoConfig::get('fucai3d');

        $generator = IssueGenerator::forge($config['issuerule'], $config['issueset'], 81);
        $generator->setDateRange($start, $end);

        $result = $generator->getArray();

        $this->assertEquals(100, count($result));

        $day1 = $result[0];
        $this->assertEquals('2017081', $day1['issue']);
        $this->assertEquals('2017-03-29', $day1['belongdate']);
        $this->assertEquals(new Carbon('2017-03-29 06:55:00'), $day1['salestart']);
        $this->assertEquals(new Carbon('2017-03-29 20:20:00'), $day1['saleend']);
        $this->assertEquals(new Carbon('2017-03-29 20:20:00'), $day1['canneldeadline']);
        $this->assertEquals(new Carbon('2017-03-29 20:30:00'), $day1['earliestwritetime']);

        $day2 = $result[1];
        $this->assertEquals('2017082', $day2['issue']);
        $this->assertEquals('2017-03-30', $day2['belongdate']);
        $this->assertEquals(new Carbon('2017-03-30 06:55:00'), $day2['salestart']);
        $this->assertEquals(new Carbon('2017-03-30 20:20:00'), $day2['saleend']);
        $this->assertEquals(new Carbon('2017-03-30 20:20:00'), $day2['canneldeadline']);
        $this->assertEquals(new Carbon('2017-03-30 20:30:00'), $day2['earliestwritetime']);

        $day99 = $result[98];
        $this->assertEquals('2017179', $day99['issue']);
        $this->assertEquals('2017-07-05', $day99['belongdate']);
        $this->assertEquals(new Carbon('2017-07-05 06:55:00'), $day99['salestart']);
        $this->assertEquals(new Carbon('2017-07-05 20:20:00'), $day99['saleend']);
        $this->assertEquals(new Carbon('2017-07-05 20:20:00'), $day99['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-05 20:30:00'), $day99['earliestwritetime']);

        $day100 = $result[99];
        $this->assertEquals('2017180', $day100['issue']);
        $this->assertEquals('2017-07-06', $day100['belongdate']);
        $this->assertEquals(new Carbon('2017-07-06 06:55:00'), $day100['salestart']);
        $this->assertEquals(new Carbon('2017-07-06 20:20:00'), $day100['saleend']);
        $this->assertEquals(new Carbon('2017-07-06 20:20:00'), $day100['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-06 20:30:00'), $day100['earliestwritetime']);
    }

    /**
     * 北京PK10奖期产生测试
     */
    public function testPK10()
    {
        $start = Carbon::create(2017, 7, 10);
        $end   = Carbon::create(2017, 7, 11);

        $config = IssueInfoConfig::get('bjpk10');

        $generator = IssueGenerator::forge($config['issuerule'], $config['issueset'], 627899);
        $generator->setDateRange($start, $end);

        $result = $generator->getArray();

        $this->assertEquals(358, count($result));

        $day1First = $result[0];
        $this->assertEquals('627899', $day1First['issue']);
        $this->assertEquals('2017-07-10', $day1First['belongdate']);
        $this->assertEquals(new Carbon('2017-07-10 09:02:10'), $day1First['salestart']);
        $this->assertEquals(new Carbon('2017-07-10 09:07:10'), $day1First['saleend']);
        $this->assertEquals(new Carbon('2017-07-10 09:06:25'), $day1First['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-10 09:07:45'), $day1First['earliestwritetime']);

        $day1Last = $result[178];
        $this->assertEquals('628077', $day1Last['issue']);
        $this->assertEquals('2017-07-10', $day1Last['belongdate']);
        $this->assertEquals(new Carbon('2017-07-10 23:52:10'), $day1Last['salestart']);
        $this->assertEquals(new Carbon('2017-07-10 23:57:10'), $day1Last['saleend']);
        $this->assertEquals(new Carbon('2017-07-10 23:56:25'), $day1Last['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-10 23:57:45'), $day1Last['earliestwritetime']);

        $day2First = $result[179];
        $this->assertEquals('628078', $day2First['issue']);
        $this->assertEquals('2017-07-11', $day2First['belongdate']);
        $this->assertEquals(new Carbon('2017-07-11 09:02:10'), $day2First['salestart']);
        $this->assertEquals(new Carbon('2017-07-11 09:07:10'), $day2First['saleend']);
        $this->assertEquals(new Carbon('2017-07-11 09:06:25'), $day2First['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-11 09:07:45'), $day2First['earliestwritetime']);

        $day2Last = $result[357];
        $this->assertEquals('628256', $day2Last['issue']);
        $this->assertEquals('2017-07-11', $day2Last['belongdate']);
        $this->assertEquals(new Carbon('2017-07-11 23:52:10'), $day2Last['salestart']);
        $this->assertEquals(new Carbon('2017-07-11 23:57:10'), $day2Last['saleend']);
        $this->assertEquals(new Carbon('2017-07-11 23:56:25'), $day2Last['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-11 23:57:45'), $day2Last['earliestwritetime']);
    }

    /**
     * 山东11选5
     */
    public function testShiyix5()
    {
        $start = Carbon::create(2017, 7, 19);
        $end   = Carbon::create(2017, 7, 20);

        $config = IssueInfoConfig::get('shiyix5');

        $generator = IssueGenerator::forge($config['issuerule'], $config['issueset']);
        $generator->setDateRange($start, $end);

        $result = $generator->getArray();

        $this->assertEquals(156, count($result));

        $day1First = $result[0];
        $this->assertEquals('20170719-01', $day1First['issue']);
        $this->assertEquals('2017-07-19', $day1First['belongdate']);
        $this->assertEquals(new Carbon('2017-07-19 06:58:00'), $day1First['salestart']);
        $this->assertEquals(new Carbon('2017-07-19 09:03:00'), $day1First['saleend']);
        $this->assertEquals(new Carbon('2017-07-19 09:03:00'), $day1First['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-19 09:05:30'), $day1First['earliestwritetime']);

        $day1Last = $result[77];
        $this->assertEquals('20170719-78', $day1Last['issue']);
        $this->assertEquals('2017-07-19', $day1Last['belongdate']);
        $this->assertEquals(new Carbon('2017-07-19 21:43:00'), $day1Last['salestart']);
        $this->assertEquals(new Carbon('2017-07-19 21:53:00'), $day1Last['saleend']);
        $this->assertEquals(new Carbon('2017-07-19 21:53:00'), $day1Last['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-19 21:55:30'), $day1Last['earliestwritetime']);

        $day2First = $result[78];
        $this->assertEquals('20170720-01', $day2First['issue']);
        $this->assertEquals('2017-07-20', $day2First['belongdate']);
        $this->assertEquals(new Carbon('2017-07-20 06:58:00'), $day2First['salestart']);
        $this->assertEquals(new Carbon('2017-07-20 09:03:00'), $day2First['saleend']);
        $this->assertEquals(new Carbon('2017-07-20 09:03:00'), $day2First['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-20 09:05:30'), $day2First['earliestwritetime']);

        $day2Last = $result[155];
        $this->assertEquals('20170720-78', $day2Last['issue']);
        $this->assertEquals('2017-07-20', $day2Last['belongdate']);
        $this->assertEquals(new Carbon('2017-07-20 21:43:00'), $day2Last['salestart']);
        $this->assertEquals(new Carbon('2017-07-20 21:53:00'), $day2Last['saleend']);
        $this->assertEquals(new Carbon('2017-07-20 21:53:00'), $day2Last['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-20 21:55:30'), $day2Last['earliestwritetime']);
    }

    /**
     * 体彩P3
     */
    public function testPailie3()
    {
        $start = Carbon::create(2017, 7, 8);
        $end   = Carbon::create(2017, 7, 19);

        $config = IssueInfoConfig::get('pailie3');

        $generator = IssueGenerator::forge($config['issuerule'], $config['issueset'], 182);
        $generator->setDateRange($start, $end);

        $result = $generator->getArray();

        $this->assertEquals(12, count($result));

        $first = $result[0];
        $this->assertEquals('2017182', $first['issue']);
        $this->assertEquals('2017-07-08', $first['belongdate']);
        $this->assertEquals(new Carbon('2017-07-08 06:55:00'), $first['salestart']);
        $this->assertEquals(new Carbon('2017-07-08 20:15:00'), $first['saleend']);
        $this->assertEquals(new Carbon('2017-07-08 20:15:00'), $first['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-08 20:25:00'), $first['earliestwritetime']);

        $day1Last = $result[11];
        $this->assertEquals('2017193', $day1Last['issue']);
        $this->assertEquals('2017-07-19', $day1Last['belongdate']);
        $this->assertEquals(new Carbon('2017-07-19 06:55:00'), $day1Last['salestart']);
        $this->assertEquals(new Carbon('2017-07-19 20:15:00'), $day1Last['saleend']);
        $this->assertEquals(new Carbon('2017-07-19 20:15:00'), $day1Last['canneldeadline']);
        $this->assertEquals(new Carbon('2017-07-19 20:25:00'), $day1Last['earliestwritetime']);
    }
}

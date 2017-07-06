<?php

namespace Tests\Unit\Issue\IssueGenerator\LegacyIssueRules;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\IssueDateTime;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSet;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSetCollection;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSetHandler;
use PHPUnit\Framework\TestCase;

class IssueSetHandlerTest extends TestCase
{
    public function testGetAndSetIssueSetGroup()
    {
        $issueSetGroup    = new IssueSetCollection();
        $handler          = new IssueSetHandler($issueSetGroup, new IssueDateTime(Carbon::today()));

        $newIssueSetGroup = new IssueSetCollection([new IssueSet(['cycle' => 300])]);
        $handler->setIssueSetGroup($newIssueSetGroup);
        $returnObject = $handler->getIssueSetGroup();

        $this->assertSame($newIssueSetGroup, $returnObject);
    }

    public function testGetAndSetIssueDateTime()
    {
        $dateTime      = new IssueDateTime(Carbon::today());
        $issueSetGroup = new IssueSetCollection();
        $handler       = new IssueSetHandler($issueSetGroup, new IssueDateTime(Carbon::create(2011, 5, 6)));

        $handler->setIssueDateTime($dateTime);
        $returnDateTime = $handler->getIssueDateTime();

        $this->assertSame($dateTime, $returnDateTime);
    }

    public function testSetUpTime()
    {
        $issueSetGroup = IssueSetCollection::loadRaw([
            ['starttime' => '12:13:14', 'cycle' => 100, 'sort' => 1],
            ['starttime' => '15:16:17', 'cycle' => 200, 'sort' => 2],
        ]);
        $handler = (new IssueSetHandler($issueSetGroup, new IssueDateTime(
            Carbon::create(2017, 3, 16, 0, 0, 0)
        )))->setUpTime();

        $returnDateTime = $handler->getIssueDateTime();

        $expects = Carbon::create(2017, 3, 16, 12, 13, 14);
        $this->assertEquals($expects, $returnDateTime->getDateTime());

        // 移动至下一个彩种设定
        $handler->getIssueSetGroup()->next();

        // 呼叫设定时间
        $returnDateTime = $handler->setUpTime()->getIssueDateTime();

        $expects = Carbon::create(2017, 3, 16, 15, 16, 17);
        $this->assertEquals($expects, $returnDateTime->getDateTime());
    }

    public function testNextIssueSet()
    {
        $issueSetGroup = IssueSetCollection::loadRaw([
            ['starttime' => '11:22:33', 'cycle' => 300],
            ['starttime' => '16:11:22', 'cycle' => 300],
        ]);
        $handler = new IssueSetHandler($issueSetGroup, new IssueDateTime(
            Carbon::create(2011, 10, 2, 0, 0, 0)
        ));

        $dateTime = $handler->nextIssueSet()->getIssueDateTime()->getDateTime();
        $nextIssueSet = $handler->getIssueSetGroup()->activated();

        $expects            = ['starttime' => [16, 11, 22], 'cycle' => 300];
        $returnNextIssueSet = ['starttime' => $nextIssueSet->get('starttime'), 'cycle' => $nextIssueSet->get('cycle')];

        $this->assertEquals($expects, $returnNextIssueSet);
        $this->assertEquals(Carbon::create(2011, 10, 2, 16, 11, 22), $dateTime);

        $nextIssueSet = $handler->nextIssueSet()->getIssueSetGroup()->activated();
        $this->assertNull($nextIssueSet);
    }

    public function testResetActivatedIssueSet()
    {
        $issueSetGroup = IssueSetCollection::loadRaw([
            ['starttime' => '11:22:33', 'cycle' => 300],
            ['starttime' => '16:11:22', 'cycle' => 300],
        ]);

        $handler = new IssueSetHandler($issueSetGroup, new IssueDateTime(
            Carbon::create(2011, 10, 2, 0, 0, 0)
        ));
        $handler->nextIssueSet();

        $resetIssueSet = $handler->resetActivatedIssueSet()->getIssueSetGroup()->activated();

        $expects            = ['starttime' => [11, 22, 33], 'cycle' => 300];
        $returnNextIssueSet = ['starttime' => $resetIssueSet->get('starttime'), 'cycle' => $resetIssueSet->get('cycle')];

        $this->assertEquals($expects, $returnNextIssueSet);
    }

    public function testNextTime()
    {
        $issueSetGroup = IssueSetCollection::loadRaw([
            ['starttime' => '11:20:30', 'endtime' => '11:35:30', 'firstendtime' => '11:30:30', 'cycle' => 300],
            ['starttime' => '12:00:00', 'endtime' => '12:30:30', 'firstendtime' => '12:30:00', 'cycle' => 300],
        ]);
        $handler = (new IssueSetHandler($issueSetGroup, new IssueDateTime(
            Carbon::create(2011, 10, 2, 0, 0, 0)
        )))->setUpTime();

        // 第一次执行
        $returnValue   = $handler->nextTime();
        $issueDateTime = $handler->getIssueDateTime()->getDateTime();

        $this->assertTrue($returnValue);
        $this->assertEquals(
            Carbon::create(2011, 10, 2, 11, 30, 30),
            $issueDateTime
        );

        // 第二次执行
        $returnValue   = $handler->nextTime();
        $issueDateTime = $handler->getIssueDateTime()->getDateTime();

        $this->assertTrue($returnValue);
        $this->assertEquals(
            Carbon::create(2011, 10, 2, 11, 35, 30),
            $issueDateTime
        );

        // 第三次执行
        $returnValue   = $handler->nextTime();
        $issueDateTime = $handler->getIssueDateTime()->getDateTime();

        $this->assertTrue($returnValue);
        $this->assertEquals(
            Carbon::create(2011, 10, 2, 12, 30, 0),
            $issueDateTime
        );

        // 第四次执行
        $returnValue   = $handler->nextTime();

        $this->assertFalse($returnValue);
    }

    public function testNextDay()
    {
        // 尚未完成测试
        $this->assertTrue(true);
    }
}

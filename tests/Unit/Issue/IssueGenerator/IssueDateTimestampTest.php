<?php

namespace Tests\Unit\Issue\IssueGenerator;

use GyTreasure\Issue\IssueGenerator\IssueDateTimestamp;

class IssueDateTimestampTest extends \PHPUnit_Framework_TestCase
{
    public function testGetSetIssueDate()
    {
        $issueDateTime = new IssueDateTimestamp(time());
        $issueDateTime->setIssueDate(2012, 12, 21);
        $issueDate = $issueDateTime->getIssueDate();
        $this->assertEquals(strtotime('2012-12-21'), $issueDate);
    }

    public function testGetDateTime()
    {
        $dateTime = strtotime('2011-10-02 13:43:51');
        $issueDateTime = new IssueDateTimestamp(time());
        $issueDateTime->setDateTime($dateTime);
        $returnValue = $issueDateTime->getDateTime();
        $this->assertEquals($dateTime, $returnValue);
    }

    public function testGetNextDay()
    {
        $date = strtotime('2010-06-03 16:34:43');
        $issueDateTime = new IssueDateTimestamp($date);
        $newIssueDateTime = $issueDateTime->getNextDay();

        $this->assertInstanceOf(IssueDateTimestamp::class, $newIssueDateTime);
        $this->assertNotSame($issueDateTime, $newIssueDateTime);
        $this->assertEquals(strtotime('2010-06-04'), $newIssueDateTime->getDateTime());
    }

    public function testCopy()
    {
        $issueDateTime     = new IssueDateTimestamp(time());
        $originalIssueDate = $issueDateTime->getIssueDate();
        $originalDateTime  = $issueDateTime->getDateTime();
        $newIssueDateTime  = $issueDateTime->copy();

        $this->assertNotSame($issueDateTime, $newIssueDateTime);
        $this->assertEquals($originalIssueDate, $newIssueDateTime->getIssueDate());
        $this->assertEquals($originalDateTime, $newIssueDateTime->getDateTime());
    }
}

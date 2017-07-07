<?php

namespace Tests\Unit\Issue\IssueGenerator;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\IssueDateTime;
use PHPUnit\Framework\TestCase;

class IssueDateTimeTest extends TestCase
{
    public function testGetSetIssueDate()
    {
        $issueDateTime = new IssueDateTime(new Carbon);
        $issueDateTime->setIssueDate(2012, 12, 21);
        $issueDate = $issueDateTime->getIssueDate();
        $this->assertEquals(new Carbon('2012-12-21'), $issueDate);
    }

    public function testGetDateTime()
    {
        $dateTime = Carbon::create(2011, 10, 2, 13, 43, 51);
        $issueDateTime = new IssueDateTime(new Carbon);
        $issueDateTime->setDateTime($dateTime);
        $returnValue = $issueDateTime->getDateTime();
        $this->assertEquals($dateTime, $returnValue);
    }

    public function testGetNextDay()
    {
        $date = Carbon::create(2010, 6, 3, 16, 34, 43);
        $issueDateTime = new IssueDateTime($date);
        $newIssueDateTime = $issueDateTime->getNextDay();

        $this->assertInstanceOf(IssueDateTime::class, $newIssueDateTime);
        $this->assertNotSame($issueDateTime, $newIssueDateTime);
        $this->assertEquals(new Carbon('2010-06-04'), $newIssueDateTime->getDateTime());
    }

    public function testCopy()
    {
        $issueDateTime     = new IssueDateTime(new Carbon);
        $originalIssueDate = $issueDateTime->getIssueDate();
        $originalDateTime  = $issueDateTime->getDateTime();
        $newIssueDateTime  = $issueDateTime->copy();

        $this->assertNotSame($issueDateTime, $newIssueDateTime);
        $this->assertNotSame($originalIssueDate, $newIssueDateTime->getIssueDate());
        $this->assertNotSame($originalDateTime, $newIssueDateTime->getDateTime());
        $this->assertEquals($originalIssueDate, $newIssueDateTime->getIssueDate());
        $this->assertEquals($originalDateTime, $newIssueDateTime->getDateTime());
    }
}
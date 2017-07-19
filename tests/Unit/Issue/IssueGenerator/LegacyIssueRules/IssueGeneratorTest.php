<?php

namespace Tests\Unit\Issue\IssueGenerator\LegacyIssueRules;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueGenerator;
use GyTreasure\Support\TimeRange;
use PHPUnit\Framework\TestCase;

class IssueGeneratorTest extends TestCase
{
    public function testGetAndSetDateRange()
    {
        $start = Carbon::create(2011, 3, 20, 20, 20, 10);
        $end   = Carbon::create(2011, 3, 25, 10, 10, 25);

        $generator = IssueGenerator::forge('Ymd-[n3]|0,1,0', []);

        $generator->setDateRange($start, $end);
        $returnDateRange = $generator->getDateRange();

        $this->assertNotEquals(compact('start', 'end'), $returnDateRange);

        $start->startOfDay();
        $end->endOfDay();

        $this->assertEquals(compact('start', 'end'), $returnDateRange);
    }

    public function testIgnoringTimeRange()
    {
        $generator = IssueGenerator::forge('Ymd-[n3]|0,1,0', []);
        $this->assertInstanceOf(TimeRange::class, $generator->ignoringTimeRange());
    }
}

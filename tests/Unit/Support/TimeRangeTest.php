<?php

namespace Tests\Unit\Support;

use Carbon\Carbon;
use GyTreasure\Support\TimeRange;
use PHPUnit\Framework\TestCase;

class TimeRangeTest extends TestCase
{
    public function testAddRange()
    {
        $start          = Carbon::create(2011, 1, 1, 0, 0, 0);
        $end            = Carbon::create(2012, 3, 26, 22, 48, 59);
        $firstRange     = [$start, $end];

        $timeRange      = new TimeRange();
        $timeRange->addRange($start, $end);

        $start          = Carbon::create(2013, 2, 2, 22, 33, 44);
        $end            = Carbon::create(2013, 2, 4, 23, 59, 59);
        $secondRange    = [$start, $end];

        $timeRange->addRange($start, $end);

        $expects        = [$firstRange, $secondRange];
        $this->assertEquals($expects, $timeRange->getList());
    }

    public function testRemoveRange()
    {
        $start          = Carbon::create(2011, 1, 1, 0, 0, 0);
        $end            = Carbon::create(2012, 3, 26, 22, 48, 59);
        $firstRange     = [$start, $end];

        $start          = Carbon::create(2013, 2, 2, 22, 33, 44);
        $end            = Carbon::create(2013, 2, 4, 23, 59, 59);
        $secondRange    = [$start, $end];

        $rangeList      = [$firstRange, $secondRange];
        $timeRange      = new TimeRange($rangeList);

        $timeRange->removeRange($firstRange[0], $firstRange[1]);

        $expects        = [$secondRange];
        $this->assertEquals($expects, $timeRange->getList());
    }

    public function testInRange()
    {
        $start          = Carbon::create(2011, 1, 1, 0, 0, 0);
        $end            = Carbon::create(2012, 3, 26, 22, 48, 59);
        $firstRange     = [$start, $end];

        $start          = Carbon::create(2013, 2, 2, 22, 33, 44);
        $end            = Carbon::create(2013, 2, 4, 23, 59, 59);
        $secondRange    = [$start, $end];

        $rangeList      = [$firstRange, $secondRange];
        $timeRange      = new TimeRange($rangeList);

        $returnValue    = $timeRange->inRange(
            Carbon::create(2010, 12, 31, 23, 59, 59)
        );
        $this->assertFalse($returnValue);

        $returnValue    = $timeRange->inRange(
            Carbon::create(2012, 3, 26, 22, 48, 59)
        );
        $this->assertTrue($returnValue);

        $returnValue    = $timeRange->inRange(
            Carbon::create(2013, 2, 2, 22, 33, 43)
        );
        $this->assertFalse($returnValue);

        $returnValue    = $timeRange->inRange(
            Carbon::create(2013, 2, 2, 22, 33, 44)
        );
        $this->assertTrue($returnValue);

        $returnValue    = $timeRange->inRange(
            Carbon::create(2013, 2, 5, 0, 0, 0)
        );
        $this->assertFalse($returnValue);
    }

    public function testClear()
    {
        $start          = Carbon::create(2011, 1, 1, 0, 0, 0);
        $end            = Carbon::create(2012, 3, 26, 22, 48, 59);
        $firstRange     = [$start, $end];

        $start          = Carbon::create(2013, 2, 2, 22, 33, 44);
        $end            = Carbon::create(2013, 2, 4, 23, 59, 59);
        $secondRange    = [$start, $end];

        $rangeList      = [$firstRange, $secondRange];
        $timeRange      = new TimeRange($rangeList);

        $timeRange->clear();

        $this->assertEquals([], $timeRange->getList());
    }

    public function testAddDay()
    {
        $now         = Carbon::now();
        $start       = $now->startOfDay();
        $end         = $now->endOfDay();
        $range       = [$start, $end];

        $timeRange   = new TimeRange();
        $timeRange->addDay($now->year, $now->month, $now->day);

        $expects     = [$range];
        $returnArray = $timeRange->getList();

        $this->assertEquals($expects, $returnArray);
    }
}

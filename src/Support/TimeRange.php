<?php

namespace GyTreasure\Support;

use Carbon\Carbon;

class TimeRange
{
    /**
     * @var array
     */
    protected $timeRangeList = [];

    public function __construct(array $rangeList = [])
    {
        foreach ($rangeList as $row)
        {
            $this->addRange($row[0], $row[1]);
        }
    }

    /**
     * 新增时间区间.
     *
     * @param  \Carbon\Carbon  $start
     * @param  \Carbon\Carbon  $end
     * @return $this
     */
    public function addRange(Carbon $start, Carbon $end)
    {
        $this->timeRangeList[] = [$start, $end];
        return $this;
    }

    /**
     * 移除时间区间.
     *
     * @param  \Carbon\Carbon  $start
     * @param  \Carbon\Carbon  $end
     * @return $this
     */
    public function removeRange(Carbon $start, Carbon $end)
    {
        $this->timeRangeList = array_values(array_filter($this->timeRangeList, function ($range) use ($start, $end) {
            return ($range != [$start, $end]);
        }));
        return $this;
    }

    /**
     * 取得时间区间清单.
     *
     * @return array
     */
    public function getList()
    {
        return $this->timeRangeList;
    }

    /**
     * 回传时间是否在区段内.
     *
     * @param  \Carbon\Carbon  $dateTime
     * @return bool
     */
    public function inRange(Carbon $dateTime)
    {
        foreach ($this->timeRangeList as $range) {

            if ($dateTime->between($range[0], $range[1])) {
                return true;
            }
        }
        return false;
    }

    /**
     * 清除时间区段.
     *
     * @return $this
     */
    public function clear()
    {
        $this->timeRangeList = [];
        return $this;
    }

    /**
     * 新增指定的日期.
     *
     * @param  int  $year
     * @param  int  $month
     * @param  int  $day
     * @return $this
     */
    public function addDay($year, $month, $day)
    {
        $startDate = Carbon::create($year, $month, $day, 0, 0, 0);
        $endDate   = $startDate->endOfDay();
        return $this->addRange($startDate, $endDate);
    }
}

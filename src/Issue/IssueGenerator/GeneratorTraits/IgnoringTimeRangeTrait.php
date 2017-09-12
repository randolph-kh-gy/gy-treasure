<?php

namespace GyTreasure\Issue\IssueGenerator\GeneratorTraits;

trait IgnoringTimeRangeTrait
{
    /**
     * 忽略奖期区间.
     *
     * @var \GyTreasure\Support\TimeRange
     */
    protected $ignoringTimeRange;

    /**
     * 忽略奖期区间.
     *
     * @return \GyTreasure\Support\TimeRange
     */
    public function ignoringTimeRange()
    {
        return $this->ignoringTimeRange;
    }
}
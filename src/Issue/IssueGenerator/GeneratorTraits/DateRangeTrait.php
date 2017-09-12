<?php

namespace GyTreasure\Issue\IssueGenerator\GeneratorTraits;

use Carbon\Carbon;

trait DateRangeTrait
{
    /**
     * @var \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSetHandler
     */
    protected $issueSetHandler;

    /**
     * 开始日期.
     *
     * @var \Carbon\Carbon
     */
    protected $startDate;

    /**
     * 结束日期.
     *
     * @var \Carbon\Carbon
     */
    protected $endDate;

    /**
     * 取得日期范围.
     *
     * @return array
     */
    public function getDateRange()
    {
        return [
            'start' => $this->startDate,
            'end'   => $this->endDate,
        ];
    }

    /**
     * 设定日期范围.
     *
     * @param  \Carbon\Carbon  $startDate
     * @param  \Carbon\Carbon  $endDate
     * @return $this
     */
    public function setDateRange(Carbon $startDate, Carbon $endDate)
    {
        $this->startDate = $startDate->copy()->startOfDay();
        $this->endDate   = $endDate->copy()->endOfDay();

        $this->issueSetHandler->setDay(
            $this->startDate->year,
            $this->startDate->month,
            $this->startDate->day
        );

        return $this;
    }
}

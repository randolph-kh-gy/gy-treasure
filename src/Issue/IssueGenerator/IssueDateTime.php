<?php

namespace GyTreasure\Issue\IssueGenerator;

use Carbon\Carbon;

/**
 * 奖期时间.
 */
class IssueDateTime
{
    /**
     * 奖期对应日期.
     *
     * @var \Carbon\Carbon
     */
    protected $issueDate;

    /**
     * 奖期时间.
     *
     * @var \Carbon\Carbon
     */
    protected $dateTime;

    /**
     * IssueDateTime constructor.
     *
     * @param \Carbon\Carbon $date
     */
    public function __construct(Carbon $date)
    {
        $this->setIssueDate($date->year, $date->month, $date->day);
        $this->setDateTime($this->getIssueDate()->copy());
    }

    /**
     * 取得奖期对应日期.
     *
     * @return \Carbon\Carbon
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * 设定奖期对应日期.
     *
     * @param  int  $year
     * @param  int  $month
     * @param  int  $day
     * @return $this
     */
    public function setIssueDate($year, $month, $day)
    {
        $this->issueDate = Carbon::create($year, $month, $day, 0, 0, 0);
        return $this;
    }

    /**
     * 取得奖期时间.
     *
     * @return \Carbon\Carbon
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * 设定奖期时间.
     *
     * @param  \Carbon\Carbon  $dateTime
     * @return $this
     */
    public function setDateTime(Carbon $dateTime)
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * 建立今天的奖期日期物件.
     *
     * @return static
     */
    public static function today()
    {
        return new static(Carbon::today());
    }

    /**
     * 取得下一天.
     *
     * @return static
     */
    public function getNextDay()
    {
        return new static($this->issueDate->copy()->addDay());
    }

    /**
     * 物件复制.
     */
    public function __clone()
    {
        $this->issueDate = $this->issueDate->copy();
        $this->dateTime  = $this->dateTime->copy();
    }

    /**
     * 物件复制.
     *
     * @return static
     */
    public function copy()
    {
        return clone $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->dateTime;
    }
}

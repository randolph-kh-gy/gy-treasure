<?php

namespace GyTreasure\Issue\IssueGenerator;

/**
 * 奖期时间. (使用 timestamp 实现)
 */
class IssueDateTimestamp
{
    /**
     * 奖期对应日期.
     *
     * @var int
     */
    protected $issueDate;

    /**
     * 奖期时间.
     *
     * @var int
     */
    protected $dateTime;

    /**
     * IssueDateTime constructor.
     *
     * @param int $date
     */
    public function __construct($date)
    {
        $$dateInfo = getdate($date);

        $this->setIssueDate($dateInfo['year'], $dateInfo['mon'], $dateInfo['mday']);
        $this->setDateTime($this->getIssueDate());
    }

    /**
     * 取得奖期对应日期.
     *
     * @return int
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
        $this->issueDate = mktime(0, 0, 0, $month, $day, $year);
        return $this;
    }

    /**
     * 取得奖期时间.
     *
     * @return int
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * 设定奖期时间.
     *
     * @param  int  $dateTime
     * @return $this
     */
    public function setDateTime($dateTime)
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
        return new static(time());
    }

    /**
     * 取得下一天.
     *
     * @return static
     */
    public function getNextDay()
    {
        return new static(strtotime('tomorrow midnight', $this->issueDate));
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
        return date('Y-m-d H:i:s', $this->dateTime);
    }
}

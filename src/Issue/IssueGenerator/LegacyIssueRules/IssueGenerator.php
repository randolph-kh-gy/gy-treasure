<?php

namespace GyTreasure\Issue\IssueGenerator\LegacyIssueRules;

use Carbon\Carbon;
use GyTreasure\Support\Arr;
use GyTreasure\Support\TimeRange;
use GyTreasure\Issue\IssueGenerator\IssueDateTime;

class IssueGenerator
{
    /**
     * @var \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueRules
     */
    protected $rules;

    /**
     * @var \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSetHandler
     */
    protected $issueSetHandler;

    /**
     * 流水号.
     *
     * @var int
     */
    protected $number = 0;

    /**
     * 忽略奖期区间.
     *
     * @var \GyTreasure\Support\TimeRange
     */
    protected $ignoringTimeRange;

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
     * IssueGenerator constructor.
     * @param \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueRules      $rules
     * @param \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSetHandler $issueSetHandler
     * @param int $startNumber
     */
    public function __construct(IssueRules $rules, IssueSetHandler $issueSetHandler, $startNumber = 1)
    {
        $this->rules             = $rules;
        $this->issueSetHandler   = $issueSetHandler;
        $this->number            = $startNumber - 1;  // 往前推一号，让程式自行加 1
        $this->ignoringTimeRange = new TimeRange();

        // 初始化开始及结束时间
        $issueDate               = $this->issueSetHandler->getIssueDateTime()->getIssueDate();
        $this->startDate         = $issueDate->copy()->startOfDay();
        $this->endDate           = $issueDate->copy()->endOfDay();
    }

    /**
     * @param  string  $issueRule
     * @param  array   $issueSet
     * @param  int     $startNumber
     * @return static
     */
    public static function forge($issueRule, array $issueSet, $startNumber = 1)
    {
        $rules           = new IssueRules($issueRule);

        $dateTime        = IssueDateTime::today();
        $collection      = IssueSetCollection::loadRaw($issueSet)->available()->sortMe();
        $issueSetHandler = new IssueSetHandler($collection, $dateTime);
        $issueSetHandler->setUpTime();

        return new static($rules, $issueSetHandler, $startNumber);
    }

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

        $this->resetNumberIfNeeded();

        return $this;
    }

    /**
     * 忽略奖期区间.
     *
     * @return \GyTreasure\Support\TimeRange
     */
    public function ignoringTimeRange()
    {
        return $this->ignoringTimeRange;
    }

    /**
     * 下一个期号变动.
     *
     * @return bool
     */
    protected function next()
    {
        if (! $this->issueSetHandler->nextTime()) {
            return false;
        }

        // 若在忽略的时间内, 跳至下一个区段
        $dateTime = $this->issueSetHandler->getIssueDateTime()->getDateTime();
        if ($this->ignoringTimeRange()->inRange($dateTime)) {
            return $this->next();
        }

        $this->nextNumber();

        return true;
    }

    /**
     * 移动至隔天.
     *
     * @return bool
     */
    protected function nextDay()
    {
        $date = $this->issueSetHandler->nextDay()->getIssueDateTime()->getIssueDate();
        $this->resetNumberIfNeeded();
        return $date->between($this->startDate, $this->endDate);
    }

    /**
     * 下一个流水号.
     *
     * @return int
     */
    protected function nextNumber()
    {
        return ++$this->number;
    }

    /**
     * 重置流水号.
     *
     * @return $this
     */
    protected function resetNumber()
    {
        $this->number = 0;
        return $this;
    }

    /**
     * 根据重置规则重置流水号.
     *
     * @return $this
     */
    protected function resetNumberIfNeeded()
    {
        $resetWhen  = Arr::get($this->rules->toArray(), 'resetWhen');

        $issueDate  = $this->issueSetHandler->getIssueDateTime()->getIssueDate();

        $isFirstDayOfMonth  = ($issueDate->day == 1);
        $isFirstDayOfYear   = ($issueDate->month == 1 && $isFirstDayOfMonth);

        if ($resetWhen['day']) {
            $this->resetNumber();
        } elseif ($resetWhen['month'] && $isFirstDayOfMonth) {
            $this->resetNumber();
        } elseif ($resetWhen['year'] && $isFirstDayOfYear) {
            $this->resetNumber();
        }

        return $this;
    }

    /**
     * 产生新期号.
     *
     * @return array|null
     */
    public function newNumber()
    {
        if ($this->next()) {
            $number            = $this->rules->format($this->issueSetHandler->getIssueDateTime()->getIssueDate(), $this->number);
            $issueSet          = $this->issueSetHandler->getIssueSetGroup()->activated();
            $issueDateTimeInfo = $issueSet->issueDateTimeInfo($this->issueSetHandler->getIssueDateTime());

            return ['issue' => $number] + $issueDateTimeInfo;
        } elseif ($this->nextDay()) {
            return $this->newNumber();
        }

        return null;
    }

    /**
     * 执行产生号码.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function run($callback)
    {
        while ($newNumber = $this->newNumber()) {
            call_user_func_array($callback, [$newNumber]);
        }
        return $this;
    }

    /**
     * 产生号码, 把所有结果以阵列回传.
     *
     * @return array
     */
    public function getArray()
    {
        $returnArray = [];
        while ($newNumber = $this->newNumber()) {
            $returnArray[] = $newNumber;
        }
        return $returnArray;
    }
}

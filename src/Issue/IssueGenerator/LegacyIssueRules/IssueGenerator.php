<?php

namespace GyTreasure\Issue\IssueGenerator\LegacyIssueRules;

use Carbon\Carbon;
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
     * @var \GyTreasure\Support\TimeRange
     */
    protected $ignoringTimeRange;

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
    }

    public static function forge($issueRule, array $issueSet)
    {
        $rules           = new IssueRules($issueRule);

        $dateTime        = new IssueDateTime(Carbon::today());
        $collection      = IssueSetCollection::loadRaw($issueSet)->available()->sortMe();
        $issueSetHandler = new IssueSetHandler($collection, $dateTime);
        $issueSetHandler->setUpTime();

        return new static($rules, $issueSetHandler);
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
        $this->issueSetHandler->nextDay();
        // TODO 未完成函式, 判断是否有隔天
        return false;
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
     * 产生新期号.
     *
     * @return array|null
     */
    public function newNumber()
    {
        if ($this->next()) {
            $number            = $this->rules->format($this->issueSetHandler->getIssueDateTime()->getDateTime(), $this->number);
            $issueSet          = $this->issueSetHandler->getIssueSetGroup()->activated();
            $issueDateTimeInfo = $issueSet->issueDateTimeInfo($this->issueSetHandler->getIssueDateTime());

            return ['issue' => $number] + $issueDateTimeInfo;
        } elseif ($this->nextDay()) {
            return $this->newNumber();
        }

        return null;
    }
}

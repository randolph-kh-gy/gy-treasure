<?php

namespace GyTreasure\Issue\IssueGenerator\LegacyIssueRules;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\IssueDateTime;

class IssueSetHandler
{
    /**
     * 彩种设定组.
     *
     * @var \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSetCollection
     */
    protected $issueSetGroup;

    /**
     * 奖期时间.
     *
     * @var \GyTreasure\Issue\IssueGenerator\IssueDateTime
     */
    protected $issueDateTime;

    /**
     * IssueSetHandler constructor.
     * @param  IssueSetCollection  $issueSetGroup
     * @param  IssueDateTime       $dateTime
     */
    public function __construct(IssueSetCollection $issueSetGroup, IssueDateTime $dateTime)
    {
        $this->setIssueSetGroup($issueSetGroup);
        $this->setIssueDateTime($dateTime);
    }

    /**
     * 设定初始时间.
     *
     * @return $this
     */
    public function setUpTime()
    {
        $active = $this->getIssueSetGroup()->activated();
        ($active) && $active->applyFirstTime($this->getIssueDateTime()->getDateTime());
        return $this;
    }

    /**
     * 尚未执行 next.
     * 当天数改变时重置 next 计算
     *
     *
     */
    public function isNextRan()
    {
        $active = $this->getIssueSetGroup()->activated();
        if ($active) {
            $firstTime = $this->getIssueDateTime()->getIssueDate()->copy();
            $active->applyFirstTime($firstTime);

            return $this->getIssueDateTime()->getDateTime()->eq($firstTime);
        }

        return false;
    }

    /**
     * 取得彩种设定组.
     *
     * @return \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSetCollection
     */
    public function getIssueSetGroup()
    {
        return $this->issueSetGroup;
    }

    /**
     * 设定彩种设定组.
     *
     * @param  \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSetCollection  $issueSetGroup
     * @return $this
     */
    public function setIssueSetGroup(IssueSetCollection $issueSetGroup)
    {
        $this->issueSetGroup = $issueSetGroup;
        return $this;
    }

    /**
     * 取得时间.
     *
     * @return \GyTreasure\Issue\IssueGenerator\IssueDateTime
     */
    public function getIssueDateTime()
    {
        return $this->issueDateTime;
    }

    /**
     * 设定时间.
     *
     * @param  \GyTreasure\Issue\IssueGenerator\IssueDateTime  $issueDateTime
     * @return $this
     */
    public function setIssueDateTime(IssueDateTime $issueDateTime)
    {
        $this->issueDateTime = $issueDateTime;
        return $this;
    }

    /**
     * 下一个彩种设定.
     *
     * @return $this
     */
    public function nextIssueSet()
    {
        $this->getIssueSetGroup()->next();
        $this->setUpTime();
        return $this;
    }

    /**
     * 重置已启用的彩种设定.
     *
     * @return $this
     */
    public function resetActivatedIssueSet()
    {
        $this->getIssueSetGroup()->reset();
        $this->setUpTime();
        return $this;
    }

    /**
     * 移动至下一个时间.
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function nextTime()
    {
        if (! $this->getIssueSetGroup()->activated()) {
            // 已经没有可使用的彩种设定, 跳出函式
            return false;
        }

        $dateTime = $this->getIssueSetGroup()->activated()->nextCycle($this->getIssueDateTime());
        if ($dateTime) {
            $this->setIssueDateTime($dateTime);
            return true;
        } else {
            return $this->nextIssueSet()->nextTime();
        }
    }

    /**
     * 移动至指定的日期.
     *
     * @param  int  $year
     * @param  int  $month
     * @param  int  $day
     * @return $this
     */
    public function setDay($year, $month, $day)
    {
        $issueDate = new IssueDateTime(Carbon::create($year, $month, $day, 0, 0, 0));
        $this->setIssueDateTime($issueDate)->resetActivatedIssueSet();
        return $this;
    }

    /**
     * 移动至下一天.
     *
     * @return $this;
     */
    public function nextDay()
    {
        $nextDay = $this->getIssueDateTime()->getNextDay();
        $this->setIssueDateTime($nextDay)->resetActivatedIssueSet();
        return $this;
    }
}

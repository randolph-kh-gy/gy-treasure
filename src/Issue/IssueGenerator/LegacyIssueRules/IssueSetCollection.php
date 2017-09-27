<?php

namespace GyTreasure\Issue\IssueGenerator\LegacyIssueRules;

use Carbon\Carbon;
use GyTreasure\Support\Collection;

class IssueSetCollection extends Collection
{
    /**
     * 启用的 index.
     *
     * @var int
     */
    protected $activatedIndex = 0;

    /**
     * IssueSetCollection constructor.
     * @param \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSet[] $items
     */
    public function __construct($items = [])
    {
        parent::__construct($items);

        $this->items = array_values(array_filter($this->items, function ($item) {
            return $item instanceof IssueSet;
        }));
    }

    /**
     * 从资料载入集合.
     *
     * @param  array  $raw
     * @return static
     */
    public static function loadRaw(array $raw)
    {
        $array = array_map(IssueSet::class . '::forge', $raw);
        return static::make($array);
    }

    /**
     * 依照 sort 值排序.
     *
     * @return static
     */
    public function sortMe()
    {
        return $this->sort(function (IssueSet $left, IssueSet $right) {
            if ($left->get('sort') < $right->get('sort')) {
                return -1;
            } elseif ($left->get('sort') > $right->get('sort')) {
                return 1;
            }
            return 0;
        });
    }

    /**
     * 取得已启用的集合.
     *
     * @return static
     */
    public function available()
    {
        return $this->filter(function (IssueSet $issueSet) {
            return $issueSet->isAvailable();
        })->values();
    }

    /**
     * 取得启用的项目.
     *
     * @return \GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSet|null
     */
    public function activated()
    {
        return $this->get($this->activatedIndex);
    }

    /**
     * 移动下一个启用的项目.
     *
     * @return $this
     */
    public function next()
    {
        ++$this->activatedIndex;
        return $this;
    }

    /**
     * 重设启用的项目.
     *
     * @return $this
     */
    public function reset()
    {
        $this->activatedIndex = 0;
        return $this;
    }

    /**
     * 总期号数量.
     *
     * @return int
     */
    public function countIssues()
    {
        return $this->reduce(function ($count, IssueSet $issueSet) {
            return $count + $issueSet->count();
        }, 0);
    }

    /**
     * 最早开奖时间.
     *
     * @param  \Carbon\Carbon  $date
     * @return \Carbon\Carbon|null
     */
    public function firstEarliestWriteTime(Carbon $date)
    {
        $first = $this->first();
        return ($first) ? $first->firstEarliestWriteTime($date) : null;
    }
}

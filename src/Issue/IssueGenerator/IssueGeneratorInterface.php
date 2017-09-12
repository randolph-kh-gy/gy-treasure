<?php

namespace GyTreasure\Issue\IssueGenerator;

use Carbon\Carbon;

interface IssueGeneratorInterface
{
    /**
     * @param  \GyTreasure\Issue\IssueStructure  $structure
     * @return static
     */
    public static function make($structure);

    /**
     * 取得日期范围.
     *
     * @return array
     */
    public function getDateRange();

    /**
     * 设定日期范围.
     *
     * @param  \Carbon\Carbon  $startDate
     * @param  \Carbon\Carbon  $endDate
     * @return $this
     */
    public function setDateRange(Carbon $startDate, Carbon $endDate);

    /**
     * 忽略奖期区间.
     *
     * @return \GyTreasure\Support\TimeRange
     */
    public function ignoringTimeRange();

    /**
     * 执行产生号码.
     *
     * @param  bool  $numbersOnly
     * @return \Generator
     */
    public function run($numbersOnly = false);

    /**
     * 产生号码, 把所有结果以阵列回传.
     *
     * @param  bool  $numbersOnly
     * @return array
     */
    public function getArray($numbersOnly = false);
}
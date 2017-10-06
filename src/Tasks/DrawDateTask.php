<?php

namespace GyTreasure\Tasks;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssuesWeakPerformance;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssuesNum;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssuesNumLess;
use GyTreasure\ApiFacades\Interfaces\ApiDrawRangeIssues;
use GyTreasure\ApiFacades\Interfaces\ApiFromIssue;
use GyTreasure\ApiLoader;

class DrawDateTask
{
    /**
     * @var \GyTreasure\Tasks\Task
     */
    protected $task;

    /**
     * DrawDateTask constructor.
     * @param \GyTreasure\Tasks\Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @param  string  $identity
     * @return static
     */
    public static function forge($identity)
    {
        return new static(new Task(ApiLoader::forge($identity)));
    }

    /**
     * @param  \Carbon\Carbon  $date
     * @param  array  $expects
     * @param  bool   $forceAll  是否强制抓取所有号码, 可能会造成大量 HTTP 连结.
     * @return array|null
     */
    public function run(Carbon $date, array $expects = [], $forceAll = false)
    {
        $result = $this->fetch($date, $expects);

        if ($forceAll) {
            // 已抓取的号码
            $issueGets  = is_array($result) ? array_column($result, 'issue') : [];

            // 抓取尚未抓取的号码
            $leftIssues = $this->apiFromIssueStrategy(array_diff($expects, $issueGets));

            // 合并结果
            $result     = is_array($result) ? array_merge($result, $leftIssues) : $leftIssues;
        }

        return $result;
    }

    /**
     * @param  \Carbon\Carbon  $date
     * @param  array  $expects
     * @return array|null
     */
    protected function fetch(Carbon $date, array $expects = [])
    {
        if (! is_null($result = $this->apiDrawDateGroupIssuesStrategy($date))) {
            return $result;
        } elseif (! is_null($result = $this->apiDrawRangeIssuesStrategy($expects))) {
            return $result;
        } elseif (! is_null($result = $this->apiDrawDateGroupIssuesWeakPerformanceStrategy($date))){
            return $result;
        } elseif (! is_null($result = $this->apiDrawLatestGroupIssuesNumStrategy($expects))) {
            return $result;
        } elseif (! is_null($result = $this->apiDrawLatestGroupIssuesStrategy())) {
            return $result;
        } elseif (! is_null($result = $this->apiDrawLatestGroupIssuesNumLessStrategy($expects))) {
            return $result;
        }

        return null;
    }

    /**
     * @param  \Carbon\Carbon  $date
     * @return array|null
     */
    public function apiDrawDateGroupIssuesStrategy(Carbon $date)
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawDateGroupIssues::class];

        return $this->task->call($api, function (ApiDrawDateGroupIssues $instance, $info) use ($date) {

            return $instance->drawDateGroupIssues($info['id'], $date);
        });
    }

    /**
     * @param  array  $expects
     * @return array|null
     */
    public function apiDrawRangeIssuesStrategy(array $expects)
    {
        if (! $expects) {
            return null;
        }

        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawRangeIssues::class];

        return $this->task->call($api, function (ApiDrawRangeIssues $instance, $info) use ($expects) {

            $from = min($expects);
            $to   = max($expects);

            return $instance->drawRangeIssues($info['id'], $from, $to);
        });
    }

    /**
     * @param  \Carbon\Carbon  $date
     * @return array|null
     */
    public function apiDrawDateGroupIssuesWeakPerformanceStrategy(Carbon $date)
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawDateGroupIssuesWeakPerformance::class];

        return $this->task->call($api, function (ApiDrawDateGroupIssuesWeakPerformance $instance, $info) use ($date) {

            return $instance->drawDateGroupIssues($info['id'], $date);
        });
    }

    /**
     * @param  array  $expects
     * @return array|null
     */
    public function apiDrawLatestGroupIssuesNumStrategy(array $expects)
    {
        if (! $expects) {
            return null;
        }

        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawLatestGroupIssuesNum::class];

        return $this->task->call($api, function (ApiDrawLatestGroupIssuesNum $instance, $info) use ($expects) {

            return $instance->drawLatestGroupIssuesNum($info['id'], count($expects));
        });
    }

    /**
     * @return array|null
     */
    public function apiDrawLatestGroupIssuesStrategy()
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawLatestGroupIssues::class];

        return $this->task->call($api, function (ApiDrawLatestGroupIssues $instance, $info) {

            return $instance->drawLatestGroupIssues($info['id']);
        });
    }

    /**
     * @param  array  $expects
     * @return array|null
     */
    public function apiDrawLatestGroupIssuesNumLessStrategy(array $expects)
    {
        if (! $expects) {
            return null;
        }

        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawLatestGroupIssuesNumLess::class];

        return $this->task->call($api, function (ApiDrawLatestGroupIssuesNumLess $instance, $info) use ($expects) {

            return $instance->drawLatestGroupIssuesNum($info['id'], count($expects));
        });
    }

    /**
     * 抓取指定的号码.
     * 每个号码会造成一个 HTTP 连结.
     *
     * @param  array  $expects
     * @return array
     */
    public function apiFromIssueStrategy(array $expects)
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiFromIssue::class];

        $returnArray = [];
        foreach ($expects as $issue) {
            $winningNumbers = $this->task->call($api, function (ApiFromIssue $instance, $info) use ($issue) {

                return $instance->fromIssue($info['id'], $issue);
            });

            if ($winningNumbers) {
                $returnArray[] = compact('winningNumbers', 'issue');
            }
        }

        return $returnArray;
    }
}

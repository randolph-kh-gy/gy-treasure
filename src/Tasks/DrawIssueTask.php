<?php

namespace GyTreasure\Tasks;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssuesLess;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawRangeIssues;
use GyTreasure\ApiFacades\Interfaces\ApiFromIssue;
use GyTreasure\ApiLoader;

class DrawIssueTask
{
    /**
     * @var \GyTreasure\Tasks\Task
     */
    protected $task;

    /**
     * DrawIssueTask constructor.
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
     * @param  string  $issue
     * @param  \Carbon\Carbon|null  $date
     * @return array|null
     */
    public function run($issue, $date = null)
    {
        if (! is_null($result = $this->apiFromIssueStrategy($issue))) {
            return $result;
        } elseif (! is_null($result = $this->apiDrawRangeIssuesStrategy($issue))) {
            return $result;
        } elseif (! is_null($result = $this->apiDrawDateGroupIssuesStrategy($issue, $date))) {
            return $result;
        } elseif (! is_null($result = $this->apiDrawDateGroupIssuesLessStrategy($issue, $date))) {
            return $result;
        } elseif (! is_null($result = $this->apiDrawLatestGroupIssuesStrategy($issue, $date))) {
            return $result;
        }

        return null;
    }

    /**
     * @param  string  $issue
     * @return array|null
     */
    public function apiFromIssueStrategy($issue)
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiFromIssue::class];

        return $this->task->call($api, function (ApiFromIssue $instance, $info) use ($issue) {

            return $instance->fromIssue($info['id'], $issue);
        });
    }

    /**
     * @param  string  $issue
     * @return array|null
     */
    public function apiDrawRangeIssuesStrategy($issue)
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawRangeIssues::class];

        return $this->task->call($api, function (ApiDrawRangeIssues $instance, $info) use ($issue) {

            $data = $instance->drawRangeIssues($info['id'], $issue, $issue);
            return $this->getWinningNumbers($data, $issue);
        });
    }

    /**
     * @param  string  $issue
     * @param  \Carbon\Carbon  $date
     * @return array|null
     */
    public function apiDrawDateGroupIssuesStrategy($issue, Carbon $date)
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawDateGroupIssues::class];

        return $this->task->call($api, function (ApiDrawDateGroupIssues $instance, $info) use ($issue, $date) {

            $data = $instance->drawDateGroupIssues($info['id'], $date);
            return $this->getWinningNumbers($data, $issue);
        });
    }

    /**
     * @param  string  $issue
     * @param  \Carbon\Carbon  $date
     * @return array|null
     */
    public function apiDrawDateGroupIssuesLessStrategy($issue, Carbon $date)
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawDateGroupIssuesLess::class];

        return $this->task->call($api, function (ApiDrawDateGroupIssuesLess $instance, $info) use ($issue, $date) {

            $data = $instance->drawDateGroupIssues($info['id'], $date);
            return $this->getWinningNumbers($data, $issue);
        });
    }

    /**
     * @param  string  $issue
     * @param  \Carbon\Carbon  $date
     * @return array|null
     */
    public function apiDrawLatestGroupIssuesStrategy($issue, Carbon $date)
    {
        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawLatestGroupIssues::class];

        return $this->task->call($api, function (ApiDrawLatestGroupIssues $instance, $info) use ($issue, $date) {

            $data = $instance->drawLatestGroupIssues($info['id']);
            return $this->getWinningNumbers($data, $issue);
        });
    }

    /**
     * @param  array   $array
     * @param  string  $issue
     * @return array|null
     */
    protected function getWinningNumbers($array, $issue)
    {
        foreach ($array as $row) {
            if ($row['issue'] == $issue) {
                return $row['winningNumbers'];
            }
        }
        return null;
    }
}

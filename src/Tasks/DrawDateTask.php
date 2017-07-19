<?php

namespace GyTreasure\Tasks;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawRangeIssues;
use GyTreasure\ApiLoader;

class DrawDateTask
{
    /**
     * @var \GyTreasure\Tasks\Task
     */
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @param  string  $identity
     * @return static
     */
    public function forge($identity)
    {
        return new static(new Task(ApiLoader::forge($identity)));
    }

    /**
     * @param  \Carbon\Carbon  $date
     * @param  array  $expects
     * @return array|null
     */
    public function run(Carbon $date, array $expects = [])
    {
        if (! is_null($result = $this->apiDrawDateGroupIssuesStrategy($date))) {
            return $result;
        } elseif (! is_null($result = $this->apiDrawRangeIssuesStrategy($expects))) {
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
            return [];
        }

        $api  = ['apiName' => 'DrawNumbers', 'forge' => 'forge', 'instanceof' => ApiDrawRangeIssues::class];

        return $this->task->call($api, function (ApiDrawRangeIssues $instance, $info) use ($expects) {

            $from = min($expects);
            $to   = max($expects);

            return $instance->drawRangeIssues($info['id'], $from, $to);
        });
    }
}

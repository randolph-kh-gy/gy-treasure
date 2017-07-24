<?php

/**
 * 此 Task 主要目地是抓取当日最早期号.
 * 并将过程中抓到的号码回传.
 */

namespace GyTreasure\Tasks;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssuesWeakPerformance;
use GyTreasure\ApiLoader;

class DrawStartIssuesTask
{
    /**
     * @var \GyTreasure\Tasks\Task
     */
    protected $task;

    /**
     * DrawStartIssuesTask constructor.
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
     * @return array|null
     */
    public function run(Carbon $date)
    {
        $issues = $this->fetch($date);
        if (! $issues) {
            return null;
        }

        $this->sortIssues($issues);

        $first = reset($issues);
        $first = $first['issue'];

        return compact('first', 'issues');
    }

    /**
     * @param  \Carbon\Carbon  $date
     * @return array|null
     */
    public function fetch(Carbon $date)
    {
        if (! is_null($result = $this->apiDrawDateGroupIssuesStrategy($date))) {
            return $result;
        } elseif (! is_null($result = $this->apiDrawDateGroupIssuesWeakPerformanceStrategy($date))) {
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
     * @param  array  $issues
     * @return $this
     */
    protected function sortIssues(array &$issues)
    {
        usort($issues, function ($a, $b) {
            if ($a['issue'] == $b['issue']) {
                return 0;
            }
            return ($a['issue'] < $b['issue']) ? -1 : 1;
        });
        return $this;
    }
}

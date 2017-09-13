<?php

namespace GyTreasure;

use Carbon\Carbon;
use GyTreasure\Issue\QuickIssue;
use GyTreasure\Tasks\DrawDateTask;
use GyTreasure\Tasks\DrawIssueTask;
use GyTreasure\Tasks\DrawStartIssuesTask;

class Drawer
{
    /**
     * 抓取一天的开号.
     *
     * @param  string  $id
     * @param  \Carbon\Carbon  $date
     * @param  int|null  $startNumber
     * @return array|null
     */
    public function drawDay($id, Carbon $date, $startNumber = null)
    {
        if ($startNumber === null) {
            if (static::isStartNumberNeeded($id)) {

                return $this->drawDayWithNoStartNumber($id, $date);

            } else {
                $startNumber = 1;
            }
        }

        $issues = static::issues($id, $date, $startNumber);

        $task = DrawDateTask::forge($id);
        return $task->run($date, $issues);
    }

    /**
     * 抓取一天的开号.
     * 此函式允许无开始期号参数.
     *
     * @param  string  $id
     * @param  \Carbon\Carbon $date
     * @return array|null
     */
    protected function drawDayWithNoStartNumber($id, Carbon $date)
    {
        $task = DrawStartIssuesTask::forge($id);
        $data = $task->run($date);
        if ($data !== null) {
            return $data['issues'];
        }

        return null;
    }

    /**
     * @param  string  $id
     * @param  string  $issue
     * @param  \Carbon\Carbon|null  $date
     * @return array|null
     */
    public function drawSingle($id, $issue, $date = null)
    {
        $task = DrawIssueTask::forge($id);
        return $task->run($issue, $date);
    }

    /**
     * @param  string  $id
     * @return bool
     */
    protected static function isStartNumberNeeded($id)
    {
        $generator = new QuickIssue();
        return $generator->getIssueRules($id)->isStartNumberNeeded();
    }

    /**
     * @param  string  $id
     * @param  \Carbon\Carbon  $date
     * @param  int  $startNumber
     * @return array
     */
    protected static function issues($id, Carbon $date, $startNumber = 1)
    {
        $generator = new QuickIssue();
        if ($date->isToday()) {
            $issues = iterator_to_array($generator->generate($id, $date, $startNumber));

            $returnArray = [];
            foreach ($issues as $row) {
                if ($row['earliestwritetime']->isPast()) {
                    $returnArray[] = $row['issue'];
                }
            }
            return $returnArray;
        } else {
            return iterator_to_array($generator->generate($id, $date, $startNumber, true));
        }
    }
}

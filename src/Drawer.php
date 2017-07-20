<?php

namespace GyTreasure;

use Carbon\Carbon;
use GyTreasure\Issue\QuickIssue;
use GyTreasure\Tasks\DrawDateTask;
use GyTreasure\Tasks\DrawIssueTask;

class Drawer
{
    /**
     * @param  string  $id
     * @param  \Carbon\Carbon  $date
     * @param  int  $startNumber
     * @return array|null
     */
    public function drawDay($id, Carbon $date, $startNumber = 1)
    {
        $issues = static::issues($id, $date, $startNumber);

        $task = DrawDateTask::forge($id);
        return $task->run($date, $issues);
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
     * @param  \Carbon\Carbon  $date
     * @param  int  $startNumber
     * @return array
     */
    protected static function issues($id, Carbon $date, $startNumber = 1)
    {
        $generator = new QuickIssue();
        if ($date->isToday()) {
            $issues = $generator->generate($id, $date, $startNumber);

            $returnArray = [];
            foreach ($issues as $row) {
                if ($row['earliestwritetime']->isPast()) {
                    $returnArray[] = $row['issue'];
                }
            }
            return $returnArray;
        } else {
            return $generator->generate($id, $date, $startNumber, true);
        }
    }
}

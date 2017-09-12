<?php

namespace GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\Scripts;

use Carbon\Carbon;

class Mm115Generator
{
    const NUM_ISSUES = 2641;

    /**
     * @param  \Carbon\Carbon  $date
     * @return array
     */
    public function generate(Carbon $date)
    {
        $belongdate  = $date->toDateString();
        $issuePrefix = $date->format('Ymd-');
        $time        = $date->setTime(0, 0, 45)->getTimestamp();

        $result = [];
        $result[] = $this->row($belongdate, $issuePrefix, 1, $this->firstIssue($time));

        for ($num = 2, $len = static::NUM_ISSUES; $num <= $len; $num++) {
            $result[] = $this->row($belongdate, $issuePrefix, $num, $this->nextIssue($time));
        }

        return $result;
    }

    /**
     * @param  string  $belongdate
     * @param  string  $issuePrefix
     * @param  int     $num
     * @param  array   $array
     * @return array
     */
    protected function row($belongdate, $issuePrefix, $num, array $array)
    {
        $issue = $issuePrefix . sprintf('%04d', $num);
        $meta  = compact('issue', 'belongdate');
        return array_merge($meta, $array);
    }

    /**
     * @param  int  $time
     * @return array
     */
    protected function firstIssue($time)
    {
        $salestart         = $time;
        $saleend           = $time;
        $canneldeadline    = $time;
        $earliestwritetime = $time;

        $array = compact('salestart', 'saleend', 'canneldeadline', 'earliestwritetime');
        $this->format($array);
        return $array;
    }

    /**
     * @param  int  $time
     * @return array
     */
    protected function nextIssue(&$time)
    {
        $salestart         = $time;
        $saleend           = $time + 30;
        $canneldeadline    = $time + 30;
        $earliestwritetime = $time + 30;

        $time += 30;

        $array = compact('salestart', 'saleend', 'canneldeadline', 'earliestwritetime');
        $this->format($array);
        return $array;
    }

    /**
     * @param array $array
     */
    protected function format(array &$array)
    {
        $array['salestart']         = Carbon::createFromTimestamp($array['salestart']);
        $array['saleend']           = Carbon::createFromTimestamp($array['saleend']);
        $array['canneldeadline']    = Carbon::createFromTimestamp($array['canneldeadline']);
        $array['earliestwritetime'] = Carbon::createFromTimestamp($array['earliestwritetime']);
    }
}

<?php

namespace GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\Scripts;

use Carbon\Carbon;

class MmSscGenerator implements IssueGenerationScript
{
    const FIRST_SEGMENT_START  = 1;
    const FIRST_SEGMENT_END    = 599;
    const SECOND_SEGMENT_START = 600;
    const SECOND_SEGMENT_END   = 2638;

    public function generate(Carbon $date, &$number = 0)
    {
        $belongdate  = $date->toDateString();
        $issuePrefix = $date->format('Ymd-');

        foreach ($this->segments() as $segment) {
            $time = $date->setTime($segment['time'][0], $segment['time'][1], $segment['time'][2])->getTimestamp();
            for ($num = $segment['start']; $num <= $segment['end']; $num++) {
                yield $this->row($belongdate, $issuePrefix, $num, $this->nextIssue($time));
            }
        }
    }

    /**
     * @return array
     */
    protected function segments()
    {
        return [
            // 第一个区间, 00:00:55 至 04:59:55
            ['start' => static::FIRST_SEGMENT_START, 'end' => static::FIRST_SEGMENT_END, 'time' => [0, 0, 55]],

            // 第二个区间, 07:00:55 至 23:59:55
            ['start' => static::SECOND_SEGMENT_START, 'end' => static::SECOND_SEGMENT_END, 'time' => [7, 0, 55]],
        ];
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

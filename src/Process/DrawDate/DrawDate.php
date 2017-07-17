<?php

namespace GyTreasure\Process\DrawDate;

use Carbon\Carbon;
use GyTreasure\ApiLoader;
use GyTreasure\Issue\QuickIssue;
use GyTreasure\Process\Process;

class DrawDate extends Process
{
    /**
     * @param  string  $identity
     * @return static
     */
    public function forge($identity)
    {
        return new static(ApiLoader::forge($identity));
    }

    /**
     * @return string
     */
    protected function initStrategy()
    {
        return 'GyTreasure\\Process\\DrawDate\\Strategies\\ApiDrawDateGroupIssuesStrategy';
    }

    /**
     * @param  \Carbon\Carbon  $date
     * @param  array|null      $expects
     * @return array|null
     */
    public function run(Carbon $date, array $expects = null)
    {
        $expects = [];
        // TODO 未完成 $expects 规格
//        // 应该要取得的奖期.
//        if ($expects === null) {
//            $issueGenerator = new QuickIssue;
//            $issues         = $issueGenerator->generate($this->loader()->identity(), $date);
//            $expects        = array_column($issues, 'issue');
//        }

        return $this->strategy()->getIssues($date, $expects);
    }
}

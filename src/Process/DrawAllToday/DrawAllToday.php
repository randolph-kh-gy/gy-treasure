<?php

namespace GyTreasure\Process\DrawAllToday;

use GyTreasure\ApiLoader;
use GyTreasure\Process\Process;

class DrawAllToday extends Process
{
    /**
     * @return string
     */
    protected function initStrategy()
    {
        return 'GyTreasure\\Process\\DrawAllToday\\Strategies\\ApiDrawLatestGroupIssuesStrategy';
    }

    /**
     * @param  string  $identity
     * @return static
     */
    public static function forge($identity)
    {
        return new static(new ApiLoader($identity));
    }

    public function run()
    {
        $data = $this->strategy()->getIssues('10002');
        print_r($data);
    }
}
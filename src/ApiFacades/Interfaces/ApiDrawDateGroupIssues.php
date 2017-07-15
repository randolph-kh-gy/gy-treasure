<?php

namespace GyTreasure\ApiFacades\Interfaces;

use Carbon\Carbon;

interface ApiDrawDateGroupIssues
{
    /**
     * 取得指定日期的开号.
     *
     * @param  string  $id
     * @param  \Carbon\Carbon  $date
     * @return array
     */
    public function drawDateGroupIssues($id, Carbon $date);
}
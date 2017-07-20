<?php

namespace GyTreasure\ApiFacades\Interfaces;

use Carbon\Carbon;

interface ApiDrawDateGroupIssuesLess
{
    /**
     * 取得指定日期的开号.
     * 此介面适用于 API 存在某些限制，造成资料不完全时.
     *
     * @param  string  $id
     * @param  \Carbon\Carbon  $date
     * @return array
     */
    public function drawDateGroupIssues($id, Carbon $date);
}

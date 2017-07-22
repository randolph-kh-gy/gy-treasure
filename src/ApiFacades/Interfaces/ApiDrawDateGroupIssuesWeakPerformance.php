<?php

namespace GyTreasure\ApiFacades\Interfaces;

use Carbon\Carbon;

interface ApiDrawDateGroupIssuesWeakPerformance
{
    /**
     * 取得指定日期的开号.
     * 此介面适用于 API 存在效能問題, 但資料依然完整時.
     *
     * @param  string  $id
     * @param  \Carbon\Carbon  $date
     * @return array
     */
    public function drawDateGroupIssues($id, Carbon $date);
}

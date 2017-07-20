<?php

namespace GyTreasure\ApiFacades\Interfaces;

interface ApiDrawLatestGroupIssuesNumLess
{
    /**
     * 取得最近的开号.
     * 此介面适用于 API 存在某些限制，造成资料不完全时.
     *
     * @param  string  $id
     * @param  int     $num
     * @return array
     */
    public function drawLatestGroupIssuesNum($id, $num);
}

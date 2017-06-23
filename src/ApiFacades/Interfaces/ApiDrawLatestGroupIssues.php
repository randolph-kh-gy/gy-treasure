<?php

namespace GyTreasure\ApiFacades\Interfaces;

interface ApiDrawLatestGroupIssues
{
    /**
     * 取得最近的开号
     *
     * @param  string  $id
     * @param  int     $num
     * @return array
     */
    public function drawLatestGroupIssues($id, $num);
}
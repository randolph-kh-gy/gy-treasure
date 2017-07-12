<?php

namespace GyTreasure\ApiFacades\Interfaces;

interface ApiDrawRangeIssues
{
    /**
     * 撷取指定范围号码.
     *
     * @param  string  $id
     * @param  string  $from
     * @param  string  $to
     * @return array
     */
    public function drawRangeIssues($id, $from, $to);
}
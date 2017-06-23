<?php

namespace GyTreasure\ApiFacades\Interfaces;

interface ApiCurrentIssue
{
    /**
     * 取得目前的开奖号
     *
     * @param  string  $id
     * @return string|null
     */
    public function currentIssue($id);
}
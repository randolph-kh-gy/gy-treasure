<?php

namespace GyTreasure\ApiFacades\Interfaces;

interface ApiFromIssue
{
    /**
     * 撷取指定号码
     *
     * @param  string  $id
     * @param  string  $issue
     * @return array|null
     */
    public function fromIssue($id, $issue);
}
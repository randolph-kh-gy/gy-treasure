<?php

namespace GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Exceptions\ApiWrongIdException;

class Factory
{
    /**
     * @param  string  $id
     * @return \GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\HistoryListInterface
     * @throws ApiWrongIdException
     */
    public function make($id)
    {
        switch ($id) {
            case '210053':
                return Sd::forge();
            case '110033':
                return P3::forge();
            default:
                throw new ApiWrongIdException('Wrong id: ' . $id);
        }
    }
}
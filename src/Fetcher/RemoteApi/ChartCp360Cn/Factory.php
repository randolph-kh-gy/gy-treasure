<?php

namespace GyTreasure\Fetcher\RemoteApi\ChartCp360Cn;

use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Exceptions\ApiWrongIdException;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Zst\Gd11;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\P3;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\Sd;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Zst\Dlc;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Zst\Syy;

class Factory
{
    /**
     * @param  string  $id
     * @return \GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HistoryListInterface
     * @throws \GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Exceptions\ApiWrongIdException
     */
    public function make($id)
    {
        switch ($id) {
            case '210053':
                return Sd::forge();
            case '110033':
                return P3::forge();
            case '166406':
                return Syy::forge();
            case '168009':
                return Dlc::forge();
            case '165707':
                return Gd11::forge();
            default:
                throw new ApiWrongIdException('Wrong id: ' . $id);
        }
    }
}

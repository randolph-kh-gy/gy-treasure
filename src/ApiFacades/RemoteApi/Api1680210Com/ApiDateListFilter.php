<?php

namespace GyTreasure\ApiFacades\RemoteApi\Api1680210Com;

use Carbon\Carbon;

class ApiDateListFilter
{
    /**
     * @var string[]
     */
    protected static $filterNeededId = [
        '10041', // 福彩 3D
        '10043', // 排列三
    ];

    /**
     * 彩种列表是否需要日期过滤.
     *
     * @param  string  $id
     * @return bool
     */
    public function isFilterNeeded($id)
    {
        return in_array($id, static::$filterNeededId);
    }

    /**
     * 使用日期过滤列表.
     *
     * @param  string  $id
     * @param  array   $array
     * @param  \Carbon\Carbon  $date
     * @return array
     */
    public function filter($id, $array, Carbon $date)
    {
        // 检查此彩种的列表是否需要过滤.
        if (! $this->isFilterNeeded($id)) {
            return $array;
        }

        return array_values(array_filter($array, function ($row) use ($date) {
            return $date->isSameDay(new Carbon($row['preDrawTime']));
        }));
    }
}

<?php

namespace GyTreasure\Fetcher\RemoteApi\Api1680210Com;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCai;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCaiList;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ElevenFive\GetElevenFiveInfo;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ElevenFive\GetElevenFiveList;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\Pks\GetLotteryPksInfo;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\Pks\GetPksHistoryList;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\QuanGuoCai\GetLotteryInfo1;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\QuanGuoCai\GetLotteryInfoList;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiWrongIdException;

class Factory
{
    /**
     * @param  string  $id
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\ApiGetInfo
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiWrongIdException
     */
    public function apiInfo($id)
    {
        switch ($id) {
            case '10001':   // 北京PK拾
                return GetLotteryPksInfo::forge();
            case '10002':   // 重庆时时彩
                return GetBaseCQShiCai::forge();
            case '10008':   // 十一运夺金
                // no break
            case '10015':   // 江西11选5
                // no break
            case '10006':   // 广东11选5
                return GetElevenFiveInfo::forge();
            case '10041':   // 福彩3D
                // no break
            case '10043':   // 体彩排列3
                return GetLotteryInfo1::forge();
            default:
                throw new ApiWrongIdException('Wrong id: ' . $id);
        }
    }

    /**
     * @param  string  $id
     * @return \GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiPrototype\ApiGetList
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Api1680210Com\Exceptions\ApiWrongIdException
     */
    public function apiList($id)
    {
        switch ($id) {
            case '10001':   // 北京PK拾
                return GetPksHistoryList::forge();
            case '10002':   // 重庆时时彩
                return GetBaseCQShiCaiList::forge();
            case '10008':   // 十一运夺金
                // no break
            case '10015':   // 江西11选5
                // no break
            case '10006':   // 广东11选5
                return GetElevenFiveList::forge();
            case '10041':   // 福彩3D
                // no break
            case '10043':   // 体彩排列3
                return GetLotteryInfoList::forge();
            default:
                throw new ApiWrongIdException('Wrong id: ' . $id);
        }
    }
}

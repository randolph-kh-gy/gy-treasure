<?php

namespace GyTreasure\Fetcher\RemoteApi\Www52kjwangCom;

use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Exceptions\ApiWrongIdException;
use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Pk10\Ajax;
use GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Pk10\Kj;

class Factory
{
    /**
     * @param  string  $id
     * @return \GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\ApiPrototype\ApiGetList
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Exceptions\ApiWrongIdException
     */
    public function apiGetList($id)
    {
        switch ($id) {
            case 'pk10':
                return Kj::forge();
            default:
                throw new ApiWrongIdException('Wrong id: ' . $id);
        }
    }

    /**
     * @param  string  $id
     * @return \GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\ApiPrototype\ApiAjax
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\Www52kjwangCom\Exceptions\ApiWrongIdException
     */
    public function apiAjax($id)
    {
        switch ($id) {
            case 'pk10':
                return Ajax::forge();
            default:
                throw new ApiWrongIdException('Wrong id: ' . $id);
        }
    }
}

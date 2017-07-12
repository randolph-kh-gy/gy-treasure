<?php

namespace GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin;

use GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Exceptions\ApiWrongIdException;

class Factory
{
    /**
     * @param  string  $id
     * @return \GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\PrevInterface
     *
     * @throws \GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Exceptions\ApiWrongIdException
     */
    public function make($id)
    {
        switch ($id) {
            case 'pk3':
                return Prevpk3::forge();
            case 'trax':
                return Prevtrax::forge();
            default:
                throw new ApiWrongIdException('Wrong id: ' . $id);
        }
    }
}
<?php

namespace GyTreasure\ApiFacades\RemoteApi\Cp360Cn;

use GyTreasure\ApiFacades\Interfaces\ApiFromIssue;
use GyTreasure\Fetcher\RemoteApi\Cp360Cn\I\Lotapi;

class DrawNumbers implements ApiFromIssue
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Cp360Cn\I\Lotapi
     */
    protected $lotapi;

    public function __construct(Lotapi $lotapi)
    {
        $this->lotapi = $lotapi;
    }

    /**
     * @return static
     */
    public function forge()
    {
        return new static(Lotapi::forge());
    }

    /**
     * 撷取指定号码.
     *
     * @param  string  $id
     * @param  string  $issue
     * @return array|null
     */
    public function fromIssue($id, $issue)
    {
        $issue  = str_replace('-', '', $issue);
        $data   = $this->lotapi->call('qkjcode', $id, $issue);
        if (is_array($data) && isset($data[0]['code']) && $data[0]['code']) {
            return IssueNumberFormatter::format($data[0]['code']);
        }
        return null;
    }
}

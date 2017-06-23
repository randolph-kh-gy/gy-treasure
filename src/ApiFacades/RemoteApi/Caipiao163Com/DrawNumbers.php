<?php

namespace GyTreasure\ApiFacades\RemoteApi\Caipiao163Com;

use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\GetAwardNumberInfo;
use GyTreasure\ApiFacades\Interfaces\ApiFromIssue;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues;

class DrawNumbers implements ApiFromIssue, ApiDrawLatestGroupIssues
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\GetAwardNumberInfo
     */
    protected $remote;

    /**
     * DrawNumber constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\GetAwardNumberInfo $remote
     */
    public function __construct(GetAwardNumberInfo $remote)
    {
        $this->remote = $remote;
    }

    public static function forge()
    {
        return new static(GetAwardNumberInfo::forge());
    }

    /**
     * 撷取指定号码
     *
     * @param  string  $id
     * @param  string  $issue
     * @return array|null
     */
    public function fromIssue($id, $issue)
    {
        $data = [
            'gameEn' => $id,
            'period' => $issue
        ];
        $response = $this->remote->call($data);

        if (isset($response['awardNumberInfoList'][0])) {
            $result = $this->_fetchWinningNumbers($response['awardNumberInfoList'][0]);
            return ($result) ? $result['winningNumbers'] : null;
        }

        return null;
    }

    /**
     * 取得最近的开号
     *
     * @param string $id
     * @param int $num
     * @return array
     */
    public function drawLatestGroupIssues($id, $num)
    {
        $data = [
            'gameEn'    => $id,
            'periodNum' => $num,
        ];
        $response = $this->remote->call($data);

        if (isset($response['awardNumberInfoList']) && is_array($response['awardNumberInfoList'])) {
            return array_values(array_filter(array_map([$this, '_fetchWinningNumbers'], $response['awardNumberInfoList'])));
        }

        return [];
    }

    protected function _fetchWinningNumbers($data)
    {
        if (
               ! is_array($data)
            || ! isset($data['winningNumber'])
            || ! isset($data['period'])
        ) {
            return null;
        }

        $winningNumbers = explode(' ', $data['winningNumber']);
        $issue          = $data['period'];

        return compact('winningNumbers', 'issue');
    }
}
<?php

namespace GyTreasure\ApiFacades\RemoteApi\Caipiao163Com;

use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\GetAwardNumberInfo;
use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Order\PreBetPeriodInfoTime;
use GyTreasure\ApiFacades\Interfaces\ApiFromIssue;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssuesNum;
use GyTreasure\ApiFacades\Interfaces\ApiCurrentIssue;

class DrawNumbers implements ApiFromIssue, ApiDrawLatestGroupIssuesNum, ApiCurrentIssue
{
    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\GetAwardNumberInfo
     */
    protected $apiNumInfo;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Order\PreBetPeriodInfoTime
     */
    protected $apiPre;

    /**
     * DrawNumber constructor.
     * @param \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\GetAwardNumberInfo   $apiNumInfo
     * @param \GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Order\PreBetPeriodInfoTime $apiPre
     */
    public function __construct(
        GetAwardNumberInfo $apiNumInfo,
        PreBetPeriodInfoTime $apiPre
    ) {
        $this->apiNumInfo = $apiNumInfo;
        $this->apiPre     = $apiPre;
    }

    /**
     * @return static
     */
    public static function forge()
    {
        return new static(
            GetAwardNumberInfo::forge(),
            PreBetPeriodInfoTime::forge()
        );
    }

    /**
     * 取得目前的开奖号
     *
     * @param  string  $id
     * @return string|null
     */
    public function currentIssue($id)
    {
        $data = [
            'gameEn' => $id,
        ];

        $response = $this->apiPre->call($data);
        return isset($response['currentPeriod']) ? $response['currentPeriod'] : null;
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
        $response = $this->apiNumInfo->call($data);

        if (isset($response['awardNumberInfoList'][0])) {
            $result = $this->_fetchWinningNumbers($response['awardNumberInfoList'][0]);
            return ($result) ? $result['winningNumbers'] : null;
        }

        return null;
    }

    /**
     * 取得最近的开号
     *
     * @param  string  $id
     * @param  int     $num
     * @return array
     */
    public function drawLatestGroupIssuesNum($id, $num)
    {
        $data = [
            'gameEn'    => $id,
            'periodNum' => $num,
        ];
        $response = $this->apiNumInfo->call($data);

        if (isset($response['awardNumberInfoList']) && is_array($response['awardNumberInfoList'])) {
            return array_values(array_filter(array_map([$this, '_fetchWinningNumbers'], $response['awardNumberInfoList'])));
        }

        return [];
    }

    /**
     * @param  array  $data
     * @return array|null
     */
    protected function _fetchWinningNumbers(array $data)
    {
        if (
               ! isset($data['winningNumber'])
            || ! isset($data['period'])
        ) {
            return null;
        }

        $winningNumbers = explode(' ', $data['winningNumber']);
        $issue          = $data['period'];

        return compact('winningNumbers', 'issue');
    }
}
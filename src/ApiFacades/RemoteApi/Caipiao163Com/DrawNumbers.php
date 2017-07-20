<?php

namespace GyTreasure\ApiFacades\RemoteApi\Caipiao163Com;

use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssuesNumLess;
use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\GetAwardNumberInfo;
use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Order\PreBetPeriodInfoTime;
use GyTreasure\ApiFacades\Interfaces\ApiCurrentIssue;

class DrawNumbers implements ApiDrawLatestGroupIssuesNumLess, ApiCurrentIssue
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
        return isset($response['currentPeriod']) ? ApiNormalizer::formatIssue($id, $response['currentPeriod']) : null;
    }

    /**
     * 取得最近的开号.
     * API 含有最多 20 笔限制，可能会造成资料抓取不完全.
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
            $data = array_values(array_filter(array_map([$this, '_fetchWinningNumbers'], $response['awardNumberInfoList'])));

            // 格式化期号格式
            array_walk($data, function (&$row) use ($id) {
                $row['issue'] = ApiNormalizer::formatIssue($id, $row['issue']);
            });

            return $data;
        }

        return [];
    }

    /**
     * @param  array  $data
     * @return array|null
     */
    protected function _fetchWinningNumbers(array $data)
    {
        if (! isset($data['winningNumber']) || ! isset($data['period'])) {
            return null;
        }

        $winningNumbers = explode(' ', $data['winningNumber']);
        $issue          = $data['period'];

        return compact('winningNumbers', 'issue');
    }
}

<?php

namespace GyTreasure\Issue\IssueGenerator\LegacyIssueRules;

use Exception;
use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\IssueDateTime;
use GyTreasure\Support\Arr;

class IssueSet
{
    /**
     * 可用属性.
     * 可供外部读取的键值名称
     *
     * @var array
     */
    protected static $properties = [
        'starttime', 'endtime', 'firstendtime', 'cycle', 'endsale',
        'inputcodetime', 'droptime', 'status', 'sort'
    ];

    /**
     * 开始时间.
     *
     * @var array
     */
    protected $starttime;

    /**
     * 结束时间.
     *
     * @var array
     */
    protected $endtime;

    /**
     * 第一次周期结束时间.
     *
     * @var array
     */
    protected $firstendtime;

    /**
     * 周期 (秒).
     *
     * @var int
     */
    protected $cycle;

    /**
     * @var int
     */
    protected $endsale;

    /**
     * @var int
     */
    protected $inputcodetime;

    /**
     * @var int
     */
    protected $droptime;

    /**
     * @var bool
     */
    protected $status;

    /**
     * @var int
     */
    protected $sort;

    /**
     * IssueSet constructor.
     * @param array $setting
     *
     * @throws \Exception
     */
    public function __construct(array $setting)
    {
        $this->starttime     = $this->parseTime(Arr::get($setting, 'starttime'));
        $this->endtime       = $this->parseTime(Arr::get($setting, 'endtime'));
        $this->firstendtime  = $this->parseTime(Arr::get($setting, 'firstendtime'));

        $this->cycle         = (int) Arr::get($setting, 'cycle', 0);
        if (! $this->cycle) {
            // 如果 cycle 没数值会造成无限回圈
            throw new Exception("Found no 'cycle' or zero, it would cause infinite loop.");
        }

        $this->endsale       = (int) Arr::get($setting, 'endsale', 0);

        $this->inputcodetime = (int) Arr::get($setting, 'inputcodetime', 0);

        $this->droptime      = (int) Arr::get($setting, 'droptime', 0);

        $this->status        = (bool) Arr::get($setting, 'status', false);

        $this->sort          = (int) Arr::get($setting, 'sort', 0);
    }

    /**
     * 建立物件实体.
     *
     * @param  array  $setting
     * @return static
     */
    public static function forge(array $setting)
    {
        return new static($setting);
    }

    /**
     * 套用开始时间.
     *
     * @param  \Carbon\Carbon  $date
     * @return \Carbon\Carbon
     */
    public function applyFirstTime($date)
    {
        return $this->setTime($date, $this->starttime);
    }

    /**
     * 取得时间范围.
     *
     * @param  \Carbon\Carbon  $date
     * @return array
     */
    public function getRange(Carbon $date)
    {
        $starttime = $this->setTime($date->copy(), $this->starttime);
        $endtime   = $this->setTime($date->copy(), $this->endtime);

        if ($endtime <= $starttime) {
            // 若时间早于或等于开始时间，那么结束时间加上一天的时间
            $endtime->addDay();
        }

        return compact('starttime', 'endtime');
    }

    /**
     * 上一次周期的时间.
     *
     * @param  \GyTreasure\Issue\IssueGenerator\IssueDateTime  $dateTime
     * @return \GyTreasure\Issue\IssueGenerator\IssueDateTime|null
     */
    public function prevCycle(IssueDateTime $dateTime)
    {
        $range         = $this->getRange($dateTime->getIssueDate());
        $firstEndTime  = $this->setTime($dateTime->getIssueDate()->copy(), $this->firstendtime);
        $isSecondCycle = $dateTime->getDateTime()->eq($firstEndTime);

        if ($isSecondCycle) {
            // 若为第二次周期，直接设定开始时间
            $newDate   = $range['starttime'];
        } else {
            $newDate   = $dateTime->getDateTime()->copy()->subSeconds($this->cycle);
        }

        // 是否在有效范围
        if ($newDate->between($range['starttime'], $range['endtime'])) {
            $newIssueDateTime = $dateTime->copy();
            $newIssueDateTime->setDateTime($newDate);
            return $newIssueDateTime;
        }
        return null;
    }

    /**
     * 下一次周期的时间.
     *
     * @param  \GyTreasure\Issue\IssueGenerator\IssueDateTime  $dateTime
     * @return \GyTreasure\Issue\IssueGenerator\IssueDateTime|null
     */
    public function nextCycle(IssueDateTime $dateTime)
    {
        $range        = $this->getRange($dateTime->getIssueDate());
        $isFirstCycle = $dateTime->getDateTime()->eq($range['starttime']);

        if ($isFirstCycle) {
            // 第一次不使用周期，直接设定时间
            $newDate  = $this->setTime($dateTime->getDateTime()->copy(), $this->firstendtime);
        } else {
            // 第二次以后使用周期设定时间
            $newDate  = $dateTime->getDateTime()->copy()->addSeconds($this->cycle);
        }

        // 是否在有效范围
        if ($newDate->between($range['starttime'], $range['endtime'])) {
            $newIssueDateTime = $dateTime->copy();
            $newIssueDateTime->setDateTime($newDate);
            return $newIssueDateTime;
        }
        return null;
    }

    /**
     * 转换时间格式.
     *
     * @param  string  $string
     * @return array
     */
    protected function parseTime($string)
    {
        if (preg_match('/^(\d{1,2}):(\d{1,2}):(\d{1,2})$/', $string, $match)) {
            return array_map('intval', array_slice($match, 1, 3));
        }
        return [0, 0, 0];
    }

    /**
     * 设定时间
     *
     * @param  \Carbon\Carbon  $date
     * @param  array   $time
     * @return \Carbon\Carbon
     */
    protected function setTime(Carbon $date, array $time)
    {
        return call_user_func_array([$date, 'setTime'], $time);
    }

    /**
     * 取得设定数值.
     *
     * @param  string  $key
     * @return mixed
     */
    public function get($key)
    {
        return in_array($key, static::$properties) ? $this->{$key} : null;
    }

    /**
     * 是否已启用.
     *
     * @return bool
     */
    public function isAvailable()
    {
        return $this->status;
    }

    /**
     * 奖期日期时间信息.
     *
     * @param  \GyTreasure\Issue\IssueGenerator\IssueDateTime  $dateTime
     * @return array
     */
    public function issueDateTimeInfo(IssueDateTime $dateTime)
    {
        // 取得开始时间
        $prev  = $this->prevCycle($dateTime);
        if ($prev) {
            $startTime     = $prev->getDateTime();
        } else {
            $range         = $this->getRange($dateTime->getIssueDate());
            $startTime     = $range['starttime'];
        }

        $belongdate        = $dateTime->getIssueDate()->format('Y-m-d');

        // 销售开始时间
        $salestart         = $startTime->copy()->subSeconds($this->endsale);

        // 销售结束时间
        $saleend           = $dateTime->getDateTime()->copy()->subSeconds($this->endsale);

        // 撤单时间
        $canneldeadline    = $dateTime->getDateTime()->copy()->subSeconds($this->droptime);

        // 最早录号时间
        $earliestwritetime = $dateTime->getDateTime()->copy()->addSeconds($this->inputcodetime);

        return compact('belongdate', 'salestart', 'saleend', 'canneldeadline', 'earliestwritetime');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'starttime'     => $this->starttime,
            'endtime'       => $this->endtime,
            'firstendtime'  => $this->firstendtime,
            'cycle'         => $this->cycle,
            'endsale'       => $this->endsale,
            'inputcodetime' => $this->inputcodetime,
            'droptime'      => $this->droptime,
            'status'        => $this->status,
            'sort'          => $this->sort,
        ];
    }
}

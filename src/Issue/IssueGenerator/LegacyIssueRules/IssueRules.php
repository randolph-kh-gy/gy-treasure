<?php

namespace GyTreasure\Issue\IssueGenerator\LegacyIssueRules;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\Exceptions\LegacyIssueRulesParsingException;

class IssueRules
{
    /**
     * 格式化字串.
     *
     * @var string
     */
    public $format;

    /**
     * 流水号重置规则.
     *
     * @var array
     */
    public $resetWhen = [
        'year'  => false,
        'month' => false,
        'day'   => false,
    ];

    /**
     * IssueRules constructor.
     * @param  string  $issueRule
     *
     * @throws \GyTreasure\Issue\IssueGenerator\Exceptions\LegacyIssueRulesParsingException
     */
    public function __construct($issueRule)
    {
        if (preg_match('/^(?<format>[^\|]*)(?:\|)(?<y>[01]),(?<m>[01]),(?<d>[01])?.*$/', $issueRule, $match)) {
            $this->format = $match['format'];
            $this->resetWhen['year']  = (! $match['y']);
            $this->resetWhen['month'] = (! $match['m']);
            $this->resetWhen['day']   = (! $match['d']);
        } else {
            throw new LegacyIssueRulesParsingException(
                'Failed to parse IssueRule string. (issueRule: ' . (string) $issueRule . ')'
            );
        }
    }

    /**
     * 取得设定.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'format'    => $this->format,
            'resetWhen' => $this->resetWhen,
        ];
    }

    /**
     * 回传是否需要起始期号.
     *
     * @return bool
     */
    public function startNumberRequired()
    {
        // 若以天重置流水号，则不需要起始期号
        return $this->resetWhen['day'];
    }

    /**
     * 格式化字串.
     *
     * @param  \Carbon\Carbon  $dateTime
     * @param  int  $number
     * @return string
     */
    public function format(Carbon $dateTime, $number)
    {
        $returnValue = IssueRulesFormatter::replaceYMD($this->format, $dateTime);
        $returnValue = IssueRulesFormatter::replaceNo($returnValue, $number);
        return $returnValue;
    }

    /**
     * @return bool
     */
    public function isStartNumberNeeded()
    {
        return ! $this->resetWhen['day'];
    }

    /**
     * 取得流水号.
     *
     * @param  string  $issue
     * @return int|null
     */
    public function getNumberFromIssue($issue)
    {
        if (preg_match('/\[n(\d+)\]/', $this->format, $match)) {
            $figure = (int) $match[1];
            $number = (int) substr($issue, -$figure);
        } else {
            $number = static::guessingNumber($issue);
        }

        return (int) max(intval($number), 1);
    }

    /**
     * 猜测流水号.
     *
     * @param  string  $issue
     * @return int|null
     */
    public static function guessingNumber($issue)
    {
        if (! is_null($number = static::guessingNumberWithDash($issue))) {
            return $number;
        } elseif (! is_null($number = static::guessingNumberWithDate($issue))) {
            return $number;
        }
        return null;
    }

    /**
     * 用 dash 符号 (-) 猜测号码.
     *
     * @param  string  $issue
     * @return int|null
     */
    public static function guessingNumberWithDash($issue)
    {
        $segments = explode('-', $issue);
        if (count($segments) > 1) {
            return (int) end($segments);
        }
        return null;
    }

    /**
     * 用日期格式猜测号码.
     *
     * @param  string  $issue
     * @return int|null
     */
    public static function guessingNumberWithDate($issue)
    {
        if (
            preg_match('/^(?<year>\d{4})(?<mon>\d{2})(?<day>\d{2})(?<num>\d{2,3})$/', $issue, $match) &&
            checkdate($match['mon'], $match['day'], $match['year'])
        ) {
            return (int) $match['num'];

        } elseif (
            preg_match('/^(?<year>\d{4})(?<num>\d{5})$/', $issue, $match) &&
            checkdate(1, 1, $match['year'])
        ) {
            return (int) $match['num'];
        }
        return null;
    }
}

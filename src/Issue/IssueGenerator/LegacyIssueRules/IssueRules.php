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
}

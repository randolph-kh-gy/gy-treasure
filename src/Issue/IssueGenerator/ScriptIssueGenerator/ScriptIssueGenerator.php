<?php

namespace GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator;

use GyTreasure\Issue\IssueGenerator\GeneratorTraits\DateRangeTrait;
use GyTreasure\Issue\IssueGenerator\GeneratorTraits\IgnoringTimeRangeTrait;
use GyTreasure\Issue\IssueGenerator\IssueGeneratorInterface;
use GyTreasure\Support\TimeRange;

class ScriptIssueGenerator implements IssueGeneratorInterface
{
    use DateRangeTrait, IgnoringTimeRangeTrait;

    /**
     * @var int
     */
    protected $lotteryId;

    /**
     * ScriptIssueGenerator constructor.
     * @param int $lotteryId
     */
    public function __construct($lotteryId)
    {
        $this->lotteryId         = $lotteryId;
        $this->ignoringTimeRange = new TimeRange();
    }

    public static function make($structure)
    {
        // TODO: Implement make() method.
    }

    public function run($numbersOnly = false)
    {

    }

    public function getArray($numbersOnly = false)
    {
        return iterator_to_array($this->run($numbersOnly));
    }
}

<?php

namespace GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\Exceptions\NoAvailableIssueScriptException;
use GyTreasure\Issue\IssueGenerator\GeneratorTraits\DateRangeTrait;
use GyTreasure\Issue\IssueGenerator\GeneratorTraits\IgnoringTimeRangeTrait;
use GyTreasure\Issue\IssueGenerator\IssueGeneratorInterface;
use GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\Scripts\Mm115Generator;
use GyTreasure\Support\TimeRange;

class ScriptIssueGenerator implements IssueGeneratorInterface
{
    use DateRangeTrait, IgnoringTimeRangeTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\Scripts\IssueGenerationScript
     */
    protected $script;

    /**
     * 流水号.
     *
     * @var int
     */
    protected $number = 0;

    /**
     * ScriptIssueGenerator constructor.
     * @param string $id
     * @param int $startNumber
     *
     * @throws \GyTreasure\Issue\IssueGenerator\Exceptions\NoAvailableIssueScriptException
     */
    public function __construct($id, $startNumber = 1)
    {
        $this->id                = $id;
        $this->number            = $startNumber - 1;  // 往前推一号，让程式自行加 1
        $this->ignoringTimeRange = new TimeRange();

        $this->setScript($this->id);
        $this->setDateRange(Carbon::today(), Carbon::today());
    }

    /**
     * @param \GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\ScriptIssueStructure $structure
     * @return static
     */
    public static function make($structure)
    {
        return new static($structure->id, $structure->startNumber);
    }

    /**
     * @return \GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\Scripts\IssueGenerationScript
     */
    public function script()
    {
        return $this->script;
    }

    /**
     * @param  string  $id
     * @return $this
     *
     * @throws \GyTreasure\Issue\IssueGenerator\Exceptions\NoAvailableIssueScriptException
     */
    protected function setScript($id)
    {
        switch ($id) {
            case 'miaomiao115':
                $this->script = new Mm115Generator();
                break;
            default:
                throw new NoAvailableIssueScriptException('No available script for this lottery: ' . $id);
        }
        return $this;
    }

    /**
     * @param  bool  $numbersOnly
     * @return \Generator
     */
    public function run($numbersOnly = false)
    {
        $date  = $this->startDate->copy();
        while ($date->lte($this->endDate)) {
            if (! $this->ignoringTimeRange()->inRange($date)) {
                foreach ($this->script()->generate($date, $this->number) as $row) {
                    yield ($numbersOnly) ? $row['issue'] : $row;

                }
            }
            $date->addDay();
        }
    }

    /**
     * @param  bool  $numbersOnly
     * @return array
     */
    public function getArray($numbersOnly = false)
    {
        return iterator_to_array($this->run($numbersOnly));
    }
}

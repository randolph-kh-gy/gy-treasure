<?php

namespace Tests\Unit\Issue\IssueGenerator\ScriptIssueGenerator;

use Carbon\Carbon;
use GyTreasure\Issue\IssueGenerator\ScriptIssueGenerator\ScriptIssueGenerator;

class ScriptIssueGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerationWithNumbersOnly()
    {
        /*
         * \Tests\Feature\Issue\IssueGenerator\ScriptIssueGenerator
         * 在上叙类别的整合测试中已测试了必要函式，不需重覆测试
         * 此单元测试只针对 $numbersOnly = true
         */

        $id        = 'miaomiao115';
        $generator = new ScriptIssueGenerator($id);
        $generator->setDateRange(new Carbon('2017-09-13'), new Carbon('2017-09-13'));

        $array = $generator->getArray(true);

        $this->assertEquals(2641, count($array));
        $this->assertEquals(['20170913-0001', '20170913-0002', '20170913-0003'], array_slice($array, 0, 3));
    }
}

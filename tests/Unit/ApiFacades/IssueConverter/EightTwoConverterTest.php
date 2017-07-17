<?php

namespace Tests\Unit\ApiFacades\IssueConverter;

use GyTreasure\ApiFacades\IssueConverter\EightTwoConverter;
use PHPUnit\Framework\TestCase;

class EightTwoConverterTest extends TestCase
{
    public function testConvert()
    {
        $issue = '20171211-01';

        $returnValue = EightTwoConverter::convert($issue);

        $this->assertEquals('2017121101', $returnValue);
    }

    public function testFormat()
    {
        $issue = '2017121101';

        $returnValue = EightTwoConverter::format($issue);

        $this->assertEquals('20171211-01', $returnValue);
    }
}
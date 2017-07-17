<?php

namespace Tests\Unit\ApiFacades\IssueConverter;

use GyTreasure\ApiFacades\IssueConverter\TwoThreeConverter;
use PHPUnit\Framework\TestCase;

class TwoThreeConverterTest extends TestCase
{
    public function testConvert()
    {
        $issue = '2017091';

        $returnValue = TwoThreeConverter::convert($issue);

        $this->assertEquals('17091', $returnValue);
    }

    public function testFormat()
    {
        $issue = '17091';

        $returnValue = TwoThreeConverter::format($issue);

        $this->assertEquals('2017091', $returnValue);
    }
}
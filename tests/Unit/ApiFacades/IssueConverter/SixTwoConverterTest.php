<?php

namespace Tests\Unit\ApiFacades\IssueConverter;

use GyTreasure\ApiFacades\IssueConverter\SixTwoConverter;
use PHPUnit\Framework\TestCase;

class SixTwoConverterTest extends TestCase
{
    public function testConvert()
    {
        $issue = '20171211-01';

        $returnValue = SixTwoConverter::convert($issue);

        $this->assertEquals('17121101', $returnValue);
    }

    public function testFormat()
    {
        $issue = '17121101';

        $returnValue = SixTwoConverter::format($issue);

        $this->assertEquals('20171211-01', $returnValue);
    }
}
<?php

namespace Tests\Unit\ApiFacades\IssueConverter;

use GyTreasure\ApiFacades\IssueConverter\SixDashTwoConverter;
use PHPUnit\Framework\TestCase;

class SixDashTwoConverterTest extends TestCase
{
    public function testConvert()
    {
        $issue          = '20170717-01';
        $apiIssue       = '170717-01';

        $returnValue    = SixDashTwoConverter::convert($issue);
        $this->assertEquals($apiIssue, $returnValue);
    }

    public function testFormat()
    {
        $issue          = '20170717-01';
        $apiIssue       = '170717-01';

        $returnValue    = SixDashTwoConverter::format($apiIssue);
        $this->assertEquals($issue, $returnValue);
    }
}
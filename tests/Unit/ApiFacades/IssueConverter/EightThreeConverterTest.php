<?php

namespace Tests\Unit\ApiFacades\IssueConverter;

use GyTreasure\ApiFacades\IssueConverter\EightThreeConverter;
use PHPUnit\Framework\TestCase;

class EightThreeConverterTest extends TestCase
{
    public function testConvert()
    {
        $issue = '20171211-001';

        $returnValue = EightThreeConverter::convert($issue);

        $this->assertEquals('20171211001', $returnValue);
    }

    public function testFormat()
    {
        $issue = '20171211001';

        $returnValue = EightThreeConverter::format($issue);

        $this->assertEquals('20171211-001', $returnValue);
    }
}
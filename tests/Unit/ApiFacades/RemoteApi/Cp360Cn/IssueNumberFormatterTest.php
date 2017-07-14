<?php

namespace Tests\Unit\ApiFacades\RemoteApi\Cp360Cn;

use GyTreasure\ApiFacades\RemoteApi\Cp360Cn\IssueNumberFormatter;
use PHPUnit\Framework\TestCase;

class IssueNumberFormatterTest extends TestCase
{
    public function testFormat()
    {
        // 福彩3D
        $returnIssueNumbers = IssueNumberFormatter::format('613+968');
        $this->assertEquals(['6', '1', '3'], $returnIssueNumbers);

        // 其它
        $returnIssueNumbers = IssueNumberFormatter::format('07 08 18 24 29 31+07');
        $this->assertEquals(['07', '08', '18', '24', '29', '31'], $returnIssueNumbers);
    }
}

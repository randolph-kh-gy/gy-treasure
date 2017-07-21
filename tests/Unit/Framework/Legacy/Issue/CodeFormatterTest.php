<?php

namespace Tests\Unit\Framework\Legacy\Issue;

use GyTreasure\Framework\Legacy\Issue\CodeFormatter;
use PHPUnit\Framework\TestCase;

class CodeFormatterTest extends TestCase
{
    public function testConvert()
    {
        // 重庆时时彩
        $returnArray = CodeFormatter::convert('chongqing_ssc', '97359');
        $this->assertEquals(['9', '7', '3', '5', '9'], $returnArray);

        // 北京PK10
        $returnArray = CodeFormatter::convert('bjpk10', '08,05,02,10,01,07,09,04,06,03');
        $this->assertEquals(['08', '05', '02', '10', '01', '07', '09', '04', '06', '03'], $returnArray);

        // 福彩3D
        $returnArray = CodeFormatter::convert('fucai3d', '352');
        $this->assertEquals(['3', '5', '2'], $returnArray);

        // 山东11选5
        $returnArray = CodeFormatter::convert('shiyix5', '07 06 09 11 05');
        $this->assertEquals(['07', '06', '09', '11', '05'], $returnArray);

        // 体彩P3
        $returnArray = CodeFormatter::convert('pailie3', '234');
        $this->assertEquals(['2', '3', '4'], $returnArray);
    }

    public function testFormat()
    {
        // 重庆时时彩
        $returnValue = CodeFormatter::format('chongqing_ssc', ['9', '7', '3', '5', '9']);
        $this->assertEquals('97359', $returnValue);

        // 北京PK10
        $returnValue = CodeFormatter::format('bjpk10', ['08', '05', '02', '10', '01', '07', '09', '04', '06', '03']);
        $this->assertEquals('08,05,02,10,01,07,09,04,06,03', $returnValue);

        // 福彩3D
        $returnValue = CodeFormatter::format('fucai3d', ['3', '5', '2']);
        $this->assertEquals('352', $returnValue);

        // 山东11选5
        $returnValue = CodeFormatter::format('shiyix5', ['07', '06', '09', '11', '05']);
        $this->assertEquals('07 06 09 11 05', $returnValue);

        // 体彩P3
        $returnValue = CodeFormatter::format('pailie3', ['2', '3', '4']);
        $this->assertEquals('234', $returnValue);
    }
}

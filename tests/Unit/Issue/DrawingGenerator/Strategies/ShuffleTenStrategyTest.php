<?php

namespace Tests\Unit\Issue\DrawingGenerator\Strategies;

use GyTreasure\Issue\DrawingGenerator\Strategies\ShuffleTenStrategy;

class ShuffleTenStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $numbers     = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'];

        $strategy    = new ShuffleTenStrategy();
        $returnArray = $strategy->generate();

        $this->assertEquals(10, count($returnArray));
        $this->assertEquals(10, count(array_unique($returnArray)));

        sort($returnArray, SORT_NUMERIC);

        $this->assertSame($numbers, $returnArray);
    }
}

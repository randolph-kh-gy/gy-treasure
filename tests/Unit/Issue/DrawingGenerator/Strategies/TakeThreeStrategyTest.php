<?php

namespace Tests\Unit\Issue\DrawingGenerator\Strategies;

use GyTreasure\Issue\DrawingGenerator\Strategies\TakeThreeStrategy;
use PHPUnit\Framework\TestCase;

class TakeThreeStrategyTest extends TestCase
{
    public function testGenerate()
    {
        $generator = new TakeThreeStrategy();
        $returnArray = $generator->generate();

        $this->assertTrue(is_array($returnArray));
        $this->assertEquals(3, count($returnArray));
    }
}

<?php

namespace Tests\Unit\Issue\DrawingGenerator\Strategies;

use GyTreasure\Issue\DrawingGenerator\Strategies\TakeFiveStrategy;
use PHPUnit\Framework\TestCase;

class TakeFiveStrategyTest extends TestCase
{
    public function testGenerate()
    {
        $generator = new TakeFiveStrategy();
        $returnArray = $generator->generate();

        $this->assertTrue(is_array($returnArray));
        $this->assertEquals(5, count($returnArray));
    }
}

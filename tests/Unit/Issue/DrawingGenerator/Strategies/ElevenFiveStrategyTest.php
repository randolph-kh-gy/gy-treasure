<?php

namespace Tests\Unit\Issue\DrawingGenerator\Strategies;

use GyTreasure\Issue\DrawingGenerator\Strategies\ElevenFiveStrategy;
use PHPUnit\Framework\TestCase;

class ElevenFiveStrategyTest extends TestCase
{
    public function testGenerate()
    {
        $generator = new ElevenFiveStrategy();
        $returnArray = $generator->generate();

        $this->assertTrue(is_array($returnArray));
        $this->assertEquals(5, count($returnArray));
        $this->assertEquals(5, count(array_unique($returnArray)));
    }
}

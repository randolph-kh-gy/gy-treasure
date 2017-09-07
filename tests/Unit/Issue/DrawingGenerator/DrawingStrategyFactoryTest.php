<?php

namespace Tests\Unit\Issue\DrawingGenerator;

use GyTreasure\Issue\DrawingGenerator\DrawingStrategyFactory;
use GyTreasure\Issue\DrawingGenerator\Strategies\ElevenFiveStrategy;
use GyTreasure\Issue\DrawingGenerator\Strategies\ShuffleTenStrategy;
use GyTreasure\Issue\DrawingGenerator\Strategies\TakeFiveStrategy;
use PHPUnit\Framework\TestCase;

class DrawingStrategyFactoryTest extends TestCase
{
    public function testMake()
    {
        $tests = [
            'miaomiao_ssc'  => TakeFiveStrategy::class,
            'yifen_ssc'     => TakeFiveStrategy::class,
            'liangfen_ssc'  => TakeFiveStrategy::class,
            'wufen_ssc'     => TakeFiveStrategy::class,
            'miaomiao115'   => ElevenFiveStrategy::class,
            'yifen115'      => ElevenFiveStrategy::class,
            'liangfen115'   => ElevenFiveStrategy::class,
            'wufen115'      => ElevenFiveStrategy::class,
            'jisu_pk10'     => ShuffleTenStrategy::class,
        ];

        foreach ($tests as $id => $class) {
            $strategy = DrawingStrategyFactory::make($id);
            $this->assertInstanceOf($class, $strategy);

            $isAvailable = DrawingStrategyFactory::isIdAvailable($id);
            $this->assertTrue($isAvailable);
        }
    }

    /**
     * @expectedException \GyTreasure\Issue\DrawingGenerator\Exceptions\UnavailableDrawingIdException
     */
    public function testUnavailableDrawingIdException()
    {
        $id = 'unknown';
        $this->assertFalse(DrawingStrategyFactory::isIdAvailable($id));
        DrawingStrategyFactory::make($id);
    }
}

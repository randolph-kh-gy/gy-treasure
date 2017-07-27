<?php

namespace GyTreasure\Issue\DrawingGenerator;

class DrawingGenerator
{
    /**
     * @var \GyTreasure\Issue\DrawingGenerator\DrawingStrategy
     */
    protected $strategy;

    /**
     * DrawingGenerator constructor.
     * @param \GyTreasure\Issue\DrawingGenerator\DrawingStrategy $strategy
     */
    public function __construct(DrawingStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @param  string  $id
     * @return static
     */
    public static function forge($id)
    {
        $strategy = DrawingStrategyFactory::make($id);
        return new static($strategy);
    }
}

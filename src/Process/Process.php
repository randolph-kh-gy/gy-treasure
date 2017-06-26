<?php

namespace GyTreasure\Process;

use GyTreasure\ApiLoader;

abstract class Process
{
    /**
     * @var \GyTreasure\ApiLoader
     */
    protected $loader;

    /**
     * @var \GyTreasure\Process\ApiStrategy
     */
    protected $strategy;

    /**
     * DrawAllToday constructor.
     * @param \GyTreasure\ApiLoader $loader
     */
    public function __construct(ApiLoader $loader)
    {
        $strategyName   = $this->initStrategy();

        $this->loader   = $loader;
        $this->setStrategy(new $strategyName($this));
    }

    /**
     * @return string
     */
    abstract protected function initStrategy();

    /**
     * @param  \GyTreasure\Process\ApiStrategy  $strategy
     * @return $this
     */
    public function setStrategy(ApiStrategy $strategy)
    {
        $this->strategy = $strategy;
        return $this;
    }

    /**
     * @return \GyTreasure\Process\ApiStrategy
     */
    public function strategy()
    {
        return $this->strategy;
    }

    /**
     * @return \GyTreasure\ApiLoader
     */
    public function loader()
    {
        return $this->loader;
    }
}
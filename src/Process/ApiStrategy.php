<?php

namespace GyTreasure\Process;

use GyTreasure\Support\Arr;

abstract class ApiStrategy
{
    use ApiStrategyCall;

    /**
     * @var \GyTreasure\Process\Process
     */
    protected $process;

    /**
     * ApiDrawLatestGroupIssuesStrategy constructor.
     * @param \GyTreasure\Process\Process $process
     */
    public function __construct(Process $process)
    {
        $this->process = $process;
    }

    /**
     * @param  string       $apiName
     * @param  string|null  $forge
     * @param  string|null  $interface
     * @return array
     */
    public function getApiInstances($apiName, $forge = null, $interface = null)
    {
        $loader = $this->process->loader();

        if ($interface) {
            $instanceof = 'GyTreasure\\ApiFacades\\Interfaces\\' . $interface;
            return $loader->getInstances($apiName, $forge, $instanceof);
        } else {
            return $loader->getInstances($apiName, $forge);
        }
    }

    /**
     * @param  string       $apiName
     * @param  string|null  $forge
     * @param  string|null  $interface
     * @return object|null
     */
    public function getApiInstance($apiName, $forge = null, $interface = null)
    {
        $instances = $this->getApiInstances($apiName, $forge, $interface);
        return Arr::first($instances);
    }

    /**
     * @return \GyTreasure\Process\Process
     */
    public function process()
    {
        return $this->process;
    }

    /**
     * @param  $class
     * @return object
     */
    public function next($class)
    {
        $next = new $class($this->process());
        $this->process->setStrategy($next);
        return $next;
    }

    /**
     * @param  object  $instance
     * @return array
     */
    public function info($instance)
    {
        $loader = $this->process()->loader();

        $instanceName = $loader->instanceName($instance);
        $config       = $loader->apiConfig($instanceName);
        $id           = Arr::get($config, 'id', $loader->identity());

        return compact('instanceName', 'config', 'id');
    }
}
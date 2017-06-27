<?php

namespace GyTreasure\Process;

use GyTreasure\Support\Arr;

abstract class ApiStrategy
{
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

        $instanceName = $loader->instanceName($instance, 'DrawNumbers');
        $config       = $loader->apiConfig($instanceName);
        $id           = Arr::get($config, 'id', $loader->identity());

        return compact('instanceName', 'config', 'id');
    }

    /**
     * @param  array        $api
     * @param  callable     $callback
     * @param  array|null   $next
     * @return mixed
     */
    public function call(array $api, $callback, $next = null)
    {
        $apiName   = Arr::get($api, 'apiName');
        $forge     = Arr::get($api, 'forge');
        $interface = Arr::get($api, 'interface');

        $instances = $this->getApiInstances($apiName, $forge, $interface);

        foreach ($instances as $instance) {
            try {
                $info = $this->info($instance);
                return call_user_func_array($callback, [$instance, $info]);
            } catch (ApiException $e) {
                // Do nothing
            }
        }

        if ($next && is_array($next)) {

            if (count($next) > 2) {
                list($class, $method, $args) = $next;
            } else {
                list($class, $method) = $next;
                $args = [];
            }
            return call_user_func_array([$this->next($class), $method], $args);

        } else {
            return null;
        }
    }
}
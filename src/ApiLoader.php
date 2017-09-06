<?php

namespace GyTreasure;

use GyTreasure\Support\Arr;
use ReflectionClass;

class ApiLoader
{
    /**
     * @var string
     */
    protected $identity;

    /**
     * @var array
     */
    protected $api;

    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @param  string  $identity
     * @param  array   $config
     */
    public function __construct($identity, array $config = [])
    {
        $this->identity = $identity;
        $this->api      = $config;
    }

    /**
     * 取得实体.
     *
     * @param  string  $identity
     * @return static
     */
    public static function forge($identity)
    {
        $config = Config::get("api.$identity", []);
        return new static($identity, $config);
    }

    /**
     * @return string
     */
    public function identity()
    {
        return $this->identity;
    }

    /**
     * @return array
     */
    public function apiNames()
    {
        return array_keys($this->api);
    }

    /**
     * @param  string  $instanceName
     * @return array
     */
    public function apiConfig($instanceName)
    {
        return $this->api[$instanceName];
    }

    /**
     * @param  object  $instance
     * @return string|null
     */
    public function instanceName($instance)
    {
        foreach ($this->instances as $groups) {
            $instanceName = array_search($instance, $groups);
            if ($instanceName !== false) {
                return $instanceName;
            }
        }
        return null;
    }

    /**
     * @param  string       $name
     * @param  string|null  $forge
     * @return array
     */
    public function loadInstances($name, $forge = null)
    {
        if (! isset($this->instances[$name])) {
            foreach ($this->api as $instanceName => $api) {
                $instance = $this->getInstance($instanceName, $name, $forge);
                if ($instance) {
                    $this->instances[$name][$instanceName] = $instance;
                }
            }
        }

        return $this->getCachedInstances($name);
    }

    /**
     * @param  string  $name
     * @return array
     */
    protected function getCachedInstances($name)
    {
        return Arr::get($this->instances, $name, []);
    }

    /**
     * @param  string       $instanceName
     * @param  string       $name
     * @param  string|null  $forge
     * @return object|null
     */
    protected function getInstance($instanceName, $name, $forge = null)
    {
        $namespace = '\\GyTreasure\\ApiFacades\\RemoteApi\\' . $instanceName . '\\' . $name;
        if (class_exists($namespace)) {
            $reflect = new ReflectionClass($namespace);
            if ($forge) {
                return $reflect->getMethod($forge)->invoke(null);
            } else {
                return $reflect->newInstance();
            }
        }

        return null;
    }

    /**
     * @param  string       $name
     * @param  string|null  $forge
     * @param  string|null  $instanceof
     * @return array
     */
    public function getInstances($name, $forge = null, $instanceof = null)
    {
        $this->loadInstances($name, $forge);

        if ($instanceof) {
            $returnArray = [];
            foreach ($this->getCachedInstances($name) as $instance) {
                if (is_a($instance, $instanceof)) {
                    $returnArray[] = $instance;
                }
            }
            return $returnArray;
        } else {
            return $this->instances;
        }
    }
}
<?php

namespace GyTreasure;

use ReflectionClass;

class ApiLoader
{
    /**
     * @var array
     */
    protected $apiNames;

    /**
     * @var array
     */
    protected $instances = [];

    /**
     * @param  string  $identity
     */
    public function __construct($identity)
    {
        $this->apiNames = Config::get("api.$identity", []);
    }

    public function getApiNames()
    {
        return $this->apiNames;
    }

    /**
     * @param  string       $name
     * @param  string|null  $forge
     * @return array
     */
    public function loadInstances($name, $forge = null)
    {
        if (! isset($this->instances[$name])) {
            foreach ($this->apiNames as $apiName) {
                $instance = $this->getInstance($apiName, $name, $forge);
                if ($instance) {
                    $this->instances[$name][] = $instance;
                }
            }
        }

        return $this->instances[$name];
    }

    /**
     * @param  string      $apiName
     * @param  string      $name
     * @param  string|null $forge
     * @return object|null
     */
    protected function getInstance($apiName, $name, $forge = null)
    {
        $namespace = '\\GyTreasure\\ApiFacades\\RemoteApi\\' . $apiName . '\\' . $name;
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
            foreach ($this->instances[$name] as $instance) {
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
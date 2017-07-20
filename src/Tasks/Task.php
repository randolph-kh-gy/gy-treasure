<?php

namespace GyTreasure\Tasks;

use GyTreasure\ApiLoader;
use GyTreasure\Fetcher\RemoteApi\Exceptions\ApiException;
use GyTreasure\Support\Arr;

class Task
{
    /**
     * @var \GyTreasure\ApiLoader
     */
    protected $apiLoader;

    /**
     * Task constructor.
     * @param \GyTreasure\ApiLoader $apiLoader
     */
    public function __construct(ApiLoader $apiLoader)
    {
        $this->apiLoader = $apiLoader;
    }

    /**
     * @return \GyTreasure\ApiLoader
     */
    public function loader()
    {
        return $this->apiLoader;
    }

    /**
     * @param  string       $apiName
     * @param  string|null  $forge
     * @param  string|null  $instanceof
     * @return array
     */
    public function getApiInstances($apiName, $forge = null, $instanceof = null)
    {
        $loader = $this->loader();

        if ($instanceof) {
            return $loader->getInstances($apiName, $forge, $instanceof);
        } else {
            return $loader->getInstances($apiName, $forge);
        }
    }

    /**
     * @param  object  $instance
     * @return array
     */
    public function info($instance)
    {
        $loader = $this->loader();

        $instanceName = $loader->instanceName($instance);
        $config       = $loader->apiConfig($instanceName);
        $id           = Arr::get($config, 'id', $loader->identity());

        return compact('instanceName', 'config', 'id');
    }

    /**
     * @param  array        $api
     * @param  callable     $callback
     * @return mixed
     */
    public function call(array $api, $callback)
    {
        $apiName    = Arr::get($api, 'apiName');
        $forge      = Arr::get($api, 'forge');
        $instanceof = Arr::get($api, 'instanceof');

        $instances = $this->getApiInstances($apiName, $forge, $instanceof);

        foreach ($instances as $instance) {
            try {
                $info = $this->info($instance);
                $data = call_user_func_array($callback, [$instance, $info]);
                if ($data !== null) {
                    return $data;
                }
            } catch (ApiException $e) {
                // Do nothing
            }
        }

        return null;
    }
}
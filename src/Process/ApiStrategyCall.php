<?php

namespace GyTreasure\Process;

use GyTreasure\Support\Arr;

trait ApiStrategyCall
{
    /**
     * @param  array        $api
     * @param  callable     $callback
     * @param  array|null   $next
     * @return mixed
     */
    public function call(array $api, $callback, $next = null)
    {
        $apiName    = Arr::get($api, 'apiName');
        $forge      = Arr::get($api, 'forge');
        $instanceof = Arr::get($api, 'instanceof');

        $instances = $this->getApiInstances($apiName, $forge, $instanceof);

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
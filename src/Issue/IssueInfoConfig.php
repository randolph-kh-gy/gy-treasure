<?php

namespace GyTreasure\Issue;

class IssueInfoConfig
{
    /**
     * @var callable|null
     */
    protected static $registerLoader = null;

    /**
     * 载入基楚设定.
     *
     * @param  string  $key
     * @return array|null
     */
    public static function get($key)
    {
        // 过滤不安全字串
        $key = static::sanitize($key);
        if (! $key) {
            return null;
        }

        if ($loader = static::getLoader()) {
            return call_user_func_array($loader, [$key]);
        } else {
            return static::loadFromFile($key);
        }
    }

    /**
     * 取得 Loader.
     *
     * @return callable|null
     */
    public static function getLoader()
    {
        return static::$registerLoader;
    }

    /**
     * 设定 Loader.
     *
     * @param  callable|null  $loader
     * @return callable|null  设定前的 Loader
     *
     * @throws \Exception
     */
    public static function setLoader($loader)
    {
        $oldLoader = static::$registerLoader;

        if ($loader !== null && ! is_callable($loader)) {
            throw new \Exception($loader . ' is not callable.');
        }

        static::$registerLoader = $loader;

        return $oldLoader;
    }

    /**
     * @param  string  $key
     * @return array|null
     */
    protected static function loadFromFile($key)
    {
        // 检查档案是否存在
        $file = GYTREASURE_ISSUEINFO_PATH . '/' . $key . '.php';
        if (! file_exists($file)) {
            return null;
        }

        return include($file);
    }

    /**
     * 过滤不安全字串.
     *
     * @param  string  $key
     * @return string
     */
    protected static function sanitize($key)
    {
        return preg_replace('/[^a-z0-9\-_]/i', '', $key);
    }
}
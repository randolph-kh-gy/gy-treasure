<?php

namespace GyTreasure;

use GyTreasure\Support\Arr;

class Config
{
    const CONFIG_DIR = __DIR__ . '/../config';

    /**
     * @var array
     */
    protected $array;

    /**
     * @var static[]
     */
    protected static $cached = [];

    /**
     * Config constructor.
     * @param array $array
     */
    public function __construct(array $array = [])
    {
        $this->array = $array;
    }

    /**
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public function getValue($key, $default = null)
    {
        return Arr::get($this->array, $key, $default);
    }

    /**
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    public static function get($key, $default = null)
    {
        $keyComponents = static::_keyComponents($key);

        $filename = $keyComponents['filename'];
        $key      = $keyComponents['key'];

        if (! isset(static::$cached[$filename])) {
            static::$cached[$filename] = new static();
            static::$cached[$filename]->load($filename);
        }

        return static::$cached[$filename]->getValue($key, $default);
    }

    /**
     * @param  string  $key
     * @return array
     */
    public static function _keyComponents($key)
    {
        $segments = explode('.', $key, 2);

        if (! $segments) {
            return [
                'filename' => false,
                'key'      => null,
            ];
        }

        return [
            'filename' => $segments[0],
            'key'      => $segments[1],
        ];
    }

    /**
     * @param  $filename
     * @return $this
     */
    public function load($filename)
    {
        $file = static::CONFIG_DIR . '/' . $filename . '.php';
        if (! file_exists($file)) {
            return $this;
        }

        $data = include($file);
        if (! is_array($data)) {
            return $this;
        }

        $this->array = $data;

        return $this;
    }
}
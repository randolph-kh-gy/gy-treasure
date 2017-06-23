<?php

namespace GyTreasure;

// use Illuminate/Support;

// TODO 未完成 config

class Config
{
    const CONFIG_DIR = __DIR__ . '';

    public static function get($key, $default)
    {
        $segments = explode(',', $key, 2);

        if (! $segments) {

        }
    }
}
<?php

namespace GyTreasure\Fetcher\RemoteApi;

abstract class BaseApiRequest
{
    /**
     * API 位址
     *
     * @return string
     */
    abstract public function baseUrl();

    /**
     * 取得实际上 API 的 URL.
     *
     * @param  string  $path  API 路径
     * @param  array   $query
     * @return string
     */
    public function apiUrl($path, array $query = [])
    {
        $baseUrl = $this->baseUrl() . $this->_normalizePath($path);
        return ($query) ? $baseUrl . '?' . http_build_query($query) : $baseUrl;
    }

    /**
     * 正规化路径
     *
     * @param  string $path
     * @return string
     */
    protected static function _normalizePath($path)
    {
        return ltrim(preg_replace('#[/\\\\]+#', '/', $path),'/');
    }
}
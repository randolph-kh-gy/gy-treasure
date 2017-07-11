<?php

namespace GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin;

abstract class HtmlTableParser
{
    /**
     * 分析 HTML 内容
     *
     * @param  string  $html
     * @return array|null
     */
    public function parse($html)
    {
        $table = $this->extractTable($html);
        if ($table === null) {
            return null;
        }

        $rows = $this->extractRows($table);
        return $rows;
    }

    /**
     * 撷取表格.
     *
     * @param  string  $html
     * @return string|null
     */
    protected function extractTable($html)
    {
        $pattern = '/'
            . $this->patternStartTable('/')
            . '(.*?)'
            . $this->patternEndTable('/')
            . '/is';

        return preg_match($pattern, $html, $match) ? $match[1] : null;
    }

    /**
     * 撷取行.
     *
     * @param  string  $html
     * @return array
     */
    abstract protected function extractRows($html);

    /**
     * @param  string|null  $delimiter
     * @return string
     */
    abstract protected function patternStartTable($delimiter = null);

    /**
     * @param  string|null  $delimiter
     * @return string
     */
    protected function patternEndTable($delimiter = null)
    {
        $arr = [
            '</table>',
        ];
        return $this->patternTags($arr, $delimiter);
    }

    /**
     * @param  array  $array
     * @param  string|null $delimiter
     * @return string
     */
    protected function patternTags($array, $delimiter = null)
    {
        $arr = array_map(function ($html) use ($delimiter) {
            return preg_quote($html, $delimiter);
        }, $array);
        return implode('\s*', $arr);
    }
}
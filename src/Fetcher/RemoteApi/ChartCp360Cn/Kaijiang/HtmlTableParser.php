<?php

namespace GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang;

abstract class HtmlTableParser
{
    const HTML_START_TABLE = '<table width=\'100%\' class=\'his-table\'>';
    const HTML_END_TABLE   = '</table>';

    /**
     * 撷取表格资料.
     *
     * @param  string  $html
     * @return array|null
     */
    public function parse($html)
    {
        /*
         * 先检查是否为空表格.
         * 空表格代表撷取成功，但没有资料.
         * 此状况发生时回传空阵列，而不是 NULL.
         */
        if ($this->isEmptyTable($html)) {
            return [];
        }

        $table = $this->extractTable($html);
        if ($table === null) {
            return null;
        }

        $rows = $this->parseRows($this->extractRows($table));
        return $rows;
    }

    /**
     * 是否为空表格.
     *
     * @param  string  $html
     * @return bool
     */
    public function isEmptyTable($html)
    {
        $pattern = '/' . preg_quote(self::HTML_START_TABLE, '/')
                   . '\s*'
                   . preg_quote(self::HTML_END_TABLE, '/') . '/is';
        return preg_match($pattern, $html);
    }

    /**
     * @param  array  $rows
     * @return array
     */
    abstract protected function parseRows($rows);

    /**
     * @param  string  $table
     * @return array
     */
    protected function extractRows($table)
    {
        preg_match_all('/\<tr\b[^>]*>(.*?)\<\/tr\>/i', $table, $matches);
        return array_map([$this, 'extractCells'], $matches[1]);
    }

    /**
     * @param  string  $row
     * @return array
     */
    protected function extractCells($row)
    {
        preg_match_all('/\<td\>(.*?)\<\/td\>/i', $row, $matches);
        return $matches[1];
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
            . '.*?' // 标题列
            . $this->patternEndHeader('/')
            . '(.*?)'
            . $this->patternEndTable('/')
            . '/is';

        return preg_match($pattern, $html, $match) ? $match[1] : null;
    }

    /**
     * @param  string|null  $delimiter
     * @return string
     */
    protected function patternStartTable($delimiter = null)
    {
        $arr = [
            self::HTML_START_TABLE,
            '<thead class=\'kaijiang\'>',
        ];
        return $this->patternTags($arr, $delimiter);
    }

    /**
     * @param  string|null $delimiter
     * @return string
     */
    protected function patternEndHeader($delimiter = null)
    {
        $arr = [
            '</thead>',
            '<tbody id=\'data-tab\'>',
        ];
        return $this->patternTags($arr, $delimiter);
    }

    /**
     * @param  string|null  $delimiter
     * @return string
     */
    protected function patternEndTable($delimiter = null)
    {
        $arr = [
            '</tbody>',
            self::HTML_END_TABLE,
        ];
        return $this->patternTags($arr, $delimiter);
    }

    /**
     * @param  array  $array
     * @param  string|null  $delimiter
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

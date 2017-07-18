<?php

namespace GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Zst;

class HtmlTableParser
{
    /**
     * @param  string  $html
     * @return array|null
     */
    public function parse($html)
    {
        $table  = $this->extractTable($html);
        if ($table === null) {
            return null;
        }

        $rows   = $this->parseRows($this->extractRows($table));
        return $rows;
    }

    /**
     * @param  array  $rows
     * @return array
     */
    protected function parseRows($rows)
    {
        $returnArray = [];
        foreach ($rows as $row) {
            $info = $this->parseInfo($row);
            if ($info) {
                $returnArray[] = $info;
            }
        }
        return $returnArray;
    }

    /**
     * @param  string  $row
     * @return array|null
     */
    protected function parseInfo($row)
    {
        $pattern = '/^\s*'
                    . $this->issuePattern('/')
                    . '\s*'
                    . preg_quote('<td class=\'tdbdr\'></td>', '/')
                    . '\s*'
                    . $this->winningNumbersPattern('/')
                    . '/';

        if (preg_match($pattern, $row, $match)) {
            return [
                'winningNumbers' => explode(' ', trim($match[2])),
                'issue'          => trim($match[1]),
            ];
        }

        return null;
    }

    /**
     * @param  string|null  $delimiter
     * @return string
     */
    protected function issuePattern($delimiter)
    {
        return preg_quote('<td class=\'tdbg_1\' >', $delimiter)
            . '(.*?)'
            . preg_quote('</td>', $delimiter);
    }

    /**
     * @param  string|null  $delimiter
     * @return string
     */
    protected function winningNumbersPattern($delimiter)
    {
        return preg_quote('<td class=\'tdbg_1\' ><strong class=\'num\'>', $delimiter)
            . '(.*?)'
            . preg_quote('</strong></td>', $delimiter);
    }

    /**
     * @param  string  $table
     * @return array
     */
    protected function extractRows($table)
    {
        preg_match_all('/\<tr\>(.*?)\<\/tr\>/', $table, $matches);
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
            '<table width=\'100%\' class=\'chart-table\'>',
            '<thead class=\'rxfb\'>',
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
            '<tbody id=\'data-tab\' class=\'zrxfb\'>',
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
            '</tbody>'
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

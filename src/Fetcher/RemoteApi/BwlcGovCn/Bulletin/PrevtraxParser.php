<?php

namespace GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin;

class PrevtraxParser
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
            . $this->_patternStartTable('/')
            . '(.*?)'
            . $this->_patternEndTable('/')
            . '/is';

        return preg_match($pattern, $html, $match) ? $match[1] : null;
    }

    /**
     * 撷取行.
     *
     * @param  string  $html
     * @return array
     */
    protected function extractRows($html)
    {
        $arr = [
            '\<tr class\="(?:odd)?"\>',
            '\<td\>(?<issue>.*?)<\/td\>',
            '\<td\>(?<code>.*?)<\/td\>',
            '\<td\>(?<date>.*?)<\/td\>',
            '\<\/tr\>',
        ];
        $pattern = '/' . implode('\s*', $arr) . '/is';

        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);

        return array_map(function ($row) {
            return [
                'issue'          => $row['issue'],
                'winningNumbers' => explode(',', $row['code']),
            ];
        }, $matches);
    }

    /**
     * @param  string|null  $delimiter
     * @return string
     */
    private function _patternStartTable($delimiter = null)
    {
        $arr = [
            '<table class="tb" width="100%">',
            '<tr>',
            '<th width="20%">期号</th>',
            '<th width="50%">开奖号码</th>',
            '<th width="30%">开奖公告</th>',
            '</tr>',
        ];
        return $this->patternTags($arr, $delimiter);
    }

    /**
     * @param  string|null  $delimiter
     * @return string
     */
    private function _patternEndTable($delimiter = null)
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
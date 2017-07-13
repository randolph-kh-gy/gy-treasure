<?php

namespace GyTreasure\Fetcher\RemoteApi\Cp360Cn\Kj;

class HallHtmlTableParser
{
    /**
     * 名称和 ID 的对应.
     * ID 使用对方的系统的定义.
     *
     * @var array
     */
    protected static $nameTable = [
        '福彩3D' => 'sd',
        '排列三' => 'p3',
    ];

    /**
     * @param  string  $html
     * @return array
     */
    public function parse($html)
    {
        $table = $this->extractTable($html);
        if ($table === null) {
            return null;
        }

        $rows  = $this->extractRows($table);
        return $rows;
    }

    /**
     * 撷取行.
     *
     * @param  string  $table
     * @return array
     */
    protected function extractRows($table)
    {
        preg_match_all('#\<tr\b[^>]*\>(.*?)\</tr\>#is', $table, $matches);
        $rows = $matches[1];

        $returnArray = [];
        foreach ($rows as $row) {
            $cells = $this->extractCells($row);
            if ($cells) {
                $id = $cells['id'];

                $returnArray[$id][] = [
                    'winningNumbers' => $cells['winningNumbers'],
                    'issue'          => $cells['issue'],
                ];
            }
        }

        return $returnArray;
    }

    /**
     * 撷取储存格.
     *
     * @param  string  $row
     * @return array|null
     */
    protected function extractCells($row)
    {
        $info   = $this->fetchInfo($row);
        $name   = $info['name'];
        $issue  = $info['issue'];

        // 过虑无效资料和不感兴趣的彩种
        if (! $info || ! isset(static::$nameTable[$name])) {
            return null;
        }

        $id             = static::$nameTable[$name];
        $winningNumbers = $this->fetchNumbers($row);

        if (! $winningNumbers) {
            return null;
        }

        return compact('id', 'winningNumbers', 'issue');
    }

    /**
     * 撷取名称及期号.
     *
     * @param  string  $row
     * @return array|null
     */
    protected function fetchInfo($row)
    {
        $namePattern  = ' class\=\'cz-name\'\>(.*?)\</a\>';
        $issuePattern = '\<span class\=\'date\'\>第 (\d+) 期\</span\>';

        $pattern = '#'
                    . $namePattern
                    . '\s*'
                    . $issuePattern
                    . '#is';

        if (preg_match($pattern, $row, $match)) {
            return [
                'name'  => trim($match[1]),
                'issue' => $match[2],
            ];
        }
        return null;
    }

    /**
     * 撷取号码.
     *
     * @param  string  $row
     * @return array
     */
    protected function fetchNumbers($row)
    {
        preg_match_all('#\<em class\=\'kaij-btn-boll[^\']*\'\>\<b\>(\d+)\</b\>\</em\>#i', $row, $matches);
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
            '<table width="100%">',
            '<thead>',
            '<tr>',
            '<th class="t1">彩种描述</th>',
            '<th class="t1">开奖详情</th>',
            '<th class="t1">实用工具</th>',
            '<th>购买彩票</th>',
            '</tr>',
            '</thead>',
            '<tbody>',
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
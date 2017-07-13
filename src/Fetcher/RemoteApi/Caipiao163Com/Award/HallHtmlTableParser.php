<?php

namespace GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award;

class HallHtmlTableParser
{
    /**
     * 处理彩种.
     *
     * @var array
     */
    protected static $tableTypeWhiteList = [
        '数字彩票', '高频彩'
    ];

    /**
     * 名称和 ID 的对应.
     * ID 使用对方的系统的定义.
     *
     * @var array
     */
    protected static $nameTable = [
        '排列3' => 'pl3',
        '重庆时时彩' => 'ssc',
    ];

    /**
     * 撷取资料.
     *
     * @param  string  $html
     * @return array
     */
    public function parse($html)
    {
        $table  = $this->extractTable($html);
        $rows   = $this->extractRows($table);

        return $rows;
    }

    /**
     * 撷取表格.
     *
     * @param  string  $table
     * @return array
     */
    protected function extractRows($table)
    {
        preg_match_all('#\<tr\b\s*\>(.*?)\</tr\>#is', $table, $matches);
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
     * 撷取储存格资料.
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
     * 撷取号码.
     *
     * @param  string  $row
     * @return array
     */
    protected function fetchNumbers($row)
    {
        preg_match_all('#\<em class\="(?:smallRedball|smallBlueball)"\>(\d+)\</em\>#', $row, $matches);
        return $matches[1];
    }

    /**
     * 撷取彩种资讯.
     *
     * @param  string  $row
     * @return array|null
     */
    protected function fetchInfo($row)
    {
        $pattern = '/'
                    . $this->patternName('/')
                    . '\s*'
                    . $this->patternIssue('/')
                    .'/is';

        if (preg_match($pattern, $row, $match)) {
            return [
                'name'  => trim($match[1]),
                'issue' => trim($match[2]),
            ];
        } else {
            return null;
        }
    }

    /**
     * 比对彩种名称.
     *
     * @param  string|null  $delimiter
     * @return string
     */
    protected function patternName($delimiter = null)
    {
        return $this->patternLinkCell('first', '(.*?)', $delimiter);
    }

    /**
     * 比对奖期期号.
     *
     * @param  string|null  $delimiter
     * @return string
     */
    protected function patternIssue($delimiter = null)
    {
        return $this->patternLinkCell('period', '(.*?)期', $delimiter);
    }

    /**
     * <td class="..."><a href="...">内容</a></td> 正则表示法.
     *
     * @param  string       $className
     * @param  string       $textPattern
     * @param  string|null  $delimiter
     * @return string
     */
    protected function patternLinkCell($className, $textPattern = '(.*?)', $delimiter = null)
    {
        $firstPart = [
            '<td class="' . $className . '">',
            '<a href="',
        ];
        $lastPart = [
            '</a>',
            '</td>',
        ];

        return $this->patternTags($firstPart, $delimiter)
            . '[^"]*'
            . preg_quote('">', $delimiter)
            . $textPattern
            . $this->patternTags($lastPart, $delimiter);
    }

    /**
     * 撷取表格.
     *
     * @param  string  $html
     * @return string|null
     */
    protected function extractTable($html)
    {
        $patternTableTitle = '\<h2 class\="title"\>\<strong\>(.*?)\<\/strong\>\<\/h2\>';

        $pattern = '/'
            . $patternTableTitle
            . '.*?'
            . $this->patternStartTable('/')
            . '.*?'
            . '<tbody>'
            . '(.*?)'
            . $this->patternEndTable('/')
            . '/is';

        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);

        $table = '';
        foreach ($matches as $match) {
            $title = trim($match[1]);

            // 只处理在彩种类别白名单的表格
            if (in_array($title, static::$tableTypeWhiteList)) {
                $table .= $match[2];
            }
        }
        return $table;
    }

    /**
     * 表头开始.
     *
     * @param  string|null  $delimiter
     * @return string
     */
    protected function patternStartTable($delimiter = null)
    {
        $arr = [
            '<table class="awardList">',
        ];
        return $this->patternTags($arr, $delimiter);
    }

    /**
     * 表格结束.
     *
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

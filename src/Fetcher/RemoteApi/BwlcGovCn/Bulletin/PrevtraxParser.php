<?php

namespace GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin;

class PrevtraxParser extends HtmlTableParser
{
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
                'winningNumbers' => explode(',', trim($row['code'])),
                'issue'          => $row['issue'],
            ];
        }, $matches);
    }

    /**
     * @param  string|null  $delimiter
     * @return string
     */
    protected function patternStartTable($delimiter = null)
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
}

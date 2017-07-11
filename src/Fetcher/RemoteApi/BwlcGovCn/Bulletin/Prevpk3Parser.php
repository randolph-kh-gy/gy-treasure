<?php

namespace GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin;

class Prevpk3Parser extends HtmlTableParser
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
            '\<tr>',
            '\<td\>(?<issue>.*?)<\/td\>',
            '\<td\>(?<first>.*?)<\/td\>',
            '\<td\>(?<second>.*?)<\/td\>',
            '\<td\>(?<third>.*?)<\/td\>',
            '\<td\>(?<date>.*?)<\/td\>',
            '\<td\>.*?<\/td\>',
            '\<\/tr\>',
        ];
        $pattern = '/' . implode('\s*', $arr) . '/is';

        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);

        return array_map(function ($row) {
            return [
                'winningNumbers' => [
                    trim($row['first']),
                    trim($row['second']),
                    trim($row['third']),
                ],
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
            '<th>百位</th>',
            '<th>十位</th>',
            '<th>个位</th>',
            '<th width="20%">开奖日期</th>',
            '<th width="20%">开奖公告</th>',
            '</tr>',
        ];
        return $this->patternTags($arr, $delimiter);
    }
}
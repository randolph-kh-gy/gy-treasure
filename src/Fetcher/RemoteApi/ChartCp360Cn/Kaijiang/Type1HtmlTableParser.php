<?php

/**
 * 第一种表格分析器.
 * 适用于福彩3D, 排列三.
 */

namespace GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang;

class Type1HtmlTableParser extends HtmlTableParser
{
    /**
     * @param  array  $rows
     * @return array
     */
    protected function parseRows($rows)
    {
        $numberPattern  = '/'
                           . preg_quote('<span class=\'ball_5\'>', '/')
                           . '(\d+)'
                           . preg_quote('</span>', '/') . '/i';

        $returnArray    = [];
        foreach ($rows as $cells) {

            $cellIssue   = $cells[0];
            $cellNumbers = $cells[2];

            if (preg_match_all($numberPattern, $cellNumbers, $matchesNumbers)) {

                $winningNumbers = $matchesNumbers[1];
                $issue          = trim($cellIssue);
                $returnArray[]  = compact('winningNumbers', 'issue');
            }
        }

        return $returnArray;
    }
}
<?php

namespace GyTreasure\Fetcher\RemoteApi\Www52kjwangCom;

class HtmlTableParser
{
    /**
     * @param  string  $html
     * @return array|null
     */
    public function parse($html)
    {
        $table  = $this->fetchTable($html);
        if ($table === null) {
            return null;
        }

        $rows   = $this->fetchRows($table);
        return $this->parseRows($rows);
    }

    /**
     * @param  string  $html
     * @return string|null
     */
    protected function fetchTable($html)
    {
        $pattern = '/\<table id\="history"\>(.*?)\<\/table\>/is';
        if (preg_match($pattern, $html, $match)) {
            return $match[1];
        }
        return null;
    }

    /**
     * @param  string  $table
     * @return array
     */
    protected function fetchRows($table)
    {
        $pattern = '/\<tr class\=\'(?:even|odd)\'\>(.*?)\<\/tr\>/is';
        preg_match_all($pattern, $table, $matches);
        return $matches[1];
    }

    /**
     * @param  array  $rows
     * @return array
     */
    protected function parseRows($rows)
    {
        $returnArray = [];
        foreach ($rows as $row) {
            // 撷取期号
            $issue          = preg_match('/(\d+) \d{2}\-\d{2} \d{2}:\d{2}/', $row, $match) ? $match[1] : null;

            // 撷取开奖号
            preg_match_all('/\<span class\=\'no(\d+)\'\>\<\/span\>/i', $row, $matches);
            $winningNumbers = $matches[1];

            if ($issue && $winningNumbers) {
                $returnArray[] = compact('winningNumbers', 'issue');
            }
        }
        return $returnArray;
    }
}

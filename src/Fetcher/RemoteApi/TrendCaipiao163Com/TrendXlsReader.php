<?php

namespace GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com;

use PHPExcel_IOFactory;
use PHPExcel_Worksheet_Row;
use PHPExcel_Exception;

class TrendXlsReader
{
    /**
     * @var \PHPExcel|null
     */
    protected $excel;

    /**
     * @var \PHPExcel_Worksheet|null
     */
    protected $sheet;

    /**
     * 读取基本走势图 XLS 文件.
     *
     * @param  string  $file
     * @return array|null
     */
    public function read($file)
    {
        try {

            $this->loadSheet($file);

            $array = array_map([$this, 'getRowData'], iterator_to_array($this->sheet->getRowIterator()));
            $array = array_values(array_filter($array));

            return $array;

        } catch (PHPExcel_Exception $e) {
            return null;
        }
    }

    /**
     * 载入 Excel 文件.
     *
     * @param  string  $file
     * @return $this
     */
    protected function loadSheet($file)
    {
        $this->excel    = PHPExcel_IOFactory::load($file);
        $this->sheet    = $this->excel->getActiveSheet();

        return $this;
    }

    /**
     * 读取一行资料.
     *
     * @param  \PHPExcel_Worksheet_Row  $row
     * @return array|null
     */
    protected function getRowData(PHPExcel_Worksheet_Row $row)
    {
        // 跳过标题列
        if ($row->getRowIndex() === 1) {
            return null;
        }

        $issue = (string) $this->sheet->getCell('A' . $row->getRowIndex())->getValue();
        if (empty($issue)) {
            return null;
        }

        $winningNumbers = [];
        foreach ($row->getCellIterator('B') as $cell) {
            $winningNumbers[] = $this->cleanText($cell->getValue());
        }

        return compact('winningNumbers', 'issue');
    }

    /**
     * @param  string  $string
     * @return string
     */
    protected function cleanText($string)
    {
        return trim(strval($string));
    }
}
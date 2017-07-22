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

            $read = $this->loadSheet($file);
            if (! $read) {
                return null;
            }

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
     * @return bool
     */
    protected function loadSheet($file)
    {
        // 原 API 无效值时会产生空白档案
        // PHPExcel 会把该档案当做 CSV 格式处理
        // 为了避免此种状况发生直接指定可能性的格式.
        $types = array('Excel2007', 'Excel5');

        foreach ($types as $type) {
            $reader = PHPExcel_IOFactory::createReader($type);
            if ($reader->canRead($file)) {
                $this->excel    = $reader->load($file);
                $this->sheet    = $this->excel->getActiveSheet();
                return true;
            }
        }

        return false;
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
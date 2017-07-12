<?php

namespace Tests\Unit\Fetcher\RemoteApi\TrendCaipiao163Com;

use GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\TrendXlsReader;
use \PHPUnit\Framework\TestCase;

class TrendXlsReaderTest extends TestCase
{
    public function testRead()
    {
        $file = __DIR__ . '/ssc.xls';

        $reader = new TrendXlsReader();
        $array = $reader->read($file);

        $this->assertEquals(120, count($array));

        $first = $array[0];
        $this->assertEquals('170711001', $first['issue']);
        $this->assertEquals([0, 9, 6, 4, 3], $first['winningNumbers']);

        $last = $array[119];
        $this->assertEquals('170711120', $last['issue']);
        $this->assertEquals([7, 7, 6, 8, 3], $last['winningNumbers']);
    }
}

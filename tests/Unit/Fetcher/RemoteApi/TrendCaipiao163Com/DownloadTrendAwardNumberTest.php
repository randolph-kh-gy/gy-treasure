<?php

namespace Tests\Unit\Fetcher\RemoteApi\TrendCaipiao163Com;

use GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\DownloadTrendAwardNumber;
use GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\FileRequest;
use GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\TrendXlsReader;
use Mockery;
use PHPUnit\Framework\TestCase;

class DownloadTrendAwardNumberTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\FileRequest
     */
    protected $fileRequest;

    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\TrendXlsReader
     */
    protected $reader;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\DownloadTrendAwardNumber
     */
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        $this->fileRequest  = Mockery::mock(FileRequest::class);

        $this->reader       = Mockery::mock(TrendXlsReader::class);

        $this->api          = new DownloadTrendAwardNumber($this->fileRequest, $this->reader);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $faker = \Faker\Factory::create();

        $gameEn      = 'ssc';
        $beginPeriod = '170711001';
        $endPeriod   = '170711120';

        $fakeRawData = $faker->paragraph();
        $data = [
            [
                'issue'             => '170711001',
                'winningNumbers'    => ['0', '9', '6', '4', '3'],
            ]
        ];

        $this->fileRequest
            ->shouldReceive('call')
            ->once()
            ->with('downloadTrendAwardNumber.html', compact('gameEn', 'beginPeriod', 'endPeriod'))
            ->andReturn($fakeRawData);

        $this->reader
            ->shouldReceive('read')
            ->once()
            ->withAnyArgs()
            ->andReturn($data);

        $returnArray = $this->api->call($gameEn, $beginPeriod, $endPeriod);

        $this->assertEquals($data, $returnArray);
    }
}
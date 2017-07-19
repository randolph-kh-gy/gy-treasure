<?php

namespace Tests\Unit\ApiFacades\RemoteApi\TrendCaipiao163Com;

use GyTreasure\ApiFacades\RemoteApi\TrendCaipiao163Com\DrawNumbers;
use GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\DownloadTrendAwardNumber;
use Mockery;
use PHPUnit\Framework\TestCase;

class DrawNumbersTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\TrendCaipiao163Com\DownloadTrendAwardNumber
     */
    protected $dtanMock;

    /**
     * @var \GyTreasure\ApiFacades\RemoteApi\TrendCaipiao163Com\DrawNumbers
     */
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        $this->dtanMock = Mockery::mock(DownloadTrendAwardNumber::class);
        $this->api      = new DrawNumbers($this->dtanMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testDrawRangeIssues()
    {
        $id         = 'ssc';
        $from       = '20170719-016';
        $to         = '20170719-017';

        $data    = [
            [
                'winningNumbers' => ['0', '4', '9', '9', '1'],
                'issue'          => '170719016',
            ],
            [
                'winningNumbers' => ['3', '1', '1', '0', '7'],
                'issue'          => '170719017',
            ],
        ];

        $expects    = [
            [
                'winningNumbers' => ['0', '4', '9', '9', '1'],
                'issue'          => '20170719-016',
            ],
            [
                'winningNumbers' => ['3', '1', '1', '0', '7'],
                'issue'          => '20170719-017',
            ],
        ];

        $this->dtanMock
            ->shouldReceive('call')
            ->once()
            ->with($id, '170719016', '170719017')
            ->andReturn($data);

        $returnArray = $this->api->drawRangeIssues($id, $from,$to);
        $this->assertEquals($expects, $returnArray);
    }
}

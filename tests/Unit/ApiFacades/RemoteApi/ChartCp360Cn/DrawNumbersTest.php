<?php

namespace Tests\Unit\ApiFacades\RemoteApi\ChartCp360Cn;


use Carbon\Carbon;
use GyTreasure\ApiFacades\RemoteApi\ChartCp360Cn\DrawNumbers;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\Factory;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\Sd;
use Mockery;
use PHPUnit\Framework\TestCase;

class DrawNumbersTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\Cp360Cn\I\Lotapi
     */
    protected $lotapiMock;

    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\Factory
     */
    protected $factoryMock;

    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\Sd
     */
    protected $sdMock;

    /**
     * @var \GyTreasure\ApiFacades\RemoteApi\ChartCp360Cn\DrawNumbers
     */
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        $this->factoryMock  = Mockery::mock(Factory::class);
        $this->sdMock       = Mockery::mock(Sd::class);

        $this->api          = new DrawNumbers($this->factoryMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testDrawDateGroupIssues()
    {
        $id     = '210053';
        $date   = '2017-07-13';

        $data   = [
            [
                'winningNumbers' => ['6', '1', '3'],
                'issue'          => '2017187',
            ]
        ];

        $this->factoryMock
            ->shouldReceive('make')
            ->once()
            ->with($id)
            ->andReturn($this->sdMock);

        $this->sdMock
            ->shouldReceive('call')
            ->once()
            ->with($id, 2, $date . '_' . $date)
            ->andReturn($data);

        $returnArray = $this->api->drawDateGroupIssues($id, new Carbon($date));
        $this->assertEquals($data, $returnArray);
    }

    public function testDrawLatestGroupIssues()
    {
        $id     = '210053';

        $data   = [
            [
                'winningNumbers' => ['6', '1', '3'],
                'issue'          => '2017187',
            ]
        ];

        $this->factoryMock
            ->shouldReceive('make')
            ->once()
            ->with($id)
            ->andReturn($this->sdMock);

        $this->sdMock
            ->shouldReceive('call')
            ->once()
            ->with($id)
            ->andReturn($data);

        $returnArray = $this->api->drawLatestGroupIssues($id);
        $this->assertEquals($data, $returnArray);
    }

    public function testDrawLatestGroupIssuesNum()
    {
        $id     = '210053';
        $num    = 1;

        $data   = [
            [
                'winningNumbers' => ['6', '1', '3'],
                'issue'          => '2017187',
            ]
        ];

        $this->factoryMock
            ->shouldReceive('make')
            ->once()
            ->with($id)
            ->andReturn($this->sdMock);

        $this->sdMock
            ->shouldReceive('call')
            ->once()
            ->with($id, 0, $num)
            ->andReturn($data);

        $returnArray = $this->api->drawLatestGroupIssuesNum($id, $num);
        $this->assertEquals($data, $returnArray);
    }

    public function drawRangeIssues()
    {
        $id     = '210053';
        $from   = '2017158';
        $to     = '2017159';

        $data = [[
            'winningNumbers' => ['8', '7', '2'],
            'issue' => '2017159',
        ], [
            'winningNumbers' => [2, 8, 5],
            'issue' => '2017158',
        ]];

        $this->factoryMock
            ->shouldReceive('make')
            ->once()
            ->with($id)
            ->andReturn($this->sdMock);

        $this->sdMock
            ->shouldReceive('call')
            ->once()
            ->with($id, 3, $from . '_' . $to)
            ->andReturn($data);

        $returnArray = $this->api->drawLatestGroupIssuesNum($id, $from, $to);
        $this->assertEquals($data, $returnArray);
    }
}

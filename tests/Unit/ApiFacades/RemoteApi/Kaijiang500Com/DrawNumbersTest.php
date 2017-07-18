<?php

namespace Tests\Unit\ApiFacades\RemoteApi\Kaijiang500Com;

use Carbon\Carbon;
use GyTreasure\ApiFacades\RemoteApi\Kaijiang500Com\DrawNumbers;
use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Factory;
use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang\Xml;
use Mockery;
use PHPUnit\Framework\TestCase;

class DrawNumbersTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Factory
     */
    protected $factoryMock;

    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang\Xml
     */
    protected $xmlMock;

    /**
     * @var \GyTreasure\ApiFacades\RemoteApi\Kaijiang500Com\DrawNumbers
     */
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        $this->factoryMock  = Mockery::mock(Factory::class);
        $this->xmlMock      = Mockery::mock(Xml::class);
        $this->api          = new DrawNumbers($this->factoryMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testDrawDateGroupIssues()
    {
        $id     = 'xjssc';
        $date   = '2017-07-14';

        $this->factoryMock
            ->shouldReceive('make')
            ->once()
            ->with($id)
            ->andReturn($this->xmlMock);

        $this->xmlMock
            ->shouldReceive('call')
            ->once()
            ->with($id, $date)
            ->andReturn([[
                'expect'    => '20170714083',
                'opencode'  => ['8', '2', '7', '2', '6'],
            ]]);

        $returnArray = $this->api->drawDateGroupIssues($id, new Carbon($date));

        $this->assertEquals([[
            'winningNumbers'    => ['8', '2', '7', '2', '6'],
            'issue'             => '20170714083',
        ]], $returnArray);
    }
}
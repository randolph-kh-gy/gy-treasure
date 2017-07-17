<?php

namespace Tests\Unit\ApiFacades\RemoteApi\Zx500Com;

use GyTreasure\ApiFacades\RemoteApi\Zx500Com\DrawNumbers;
use GyTreasure\Fetcher\RemoteApi\Zx500Com\Info\Kaijiang\Xml;
use Mockery;
use PHPUnit\Framework\TestCase;

class DrawNumbersTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\Zx500Com\Info\Kaijiang\Xml
     */
    protected $xmlMock;

    /**
     * @var \GyTreasure\ApiFacades\RemoteApi\Zx500Com\DrawNumbers
     */
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        $this->xmlMock  = Mockery::mock(Xml::class);
        $this->api      = new DrawNumbers($this->xmlMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testFromIssue()
    {
        $id     = 'sd';
        $issue  = '2017190';

        $data   = ['8', '8', '3'];

        $this->xmlMock
            ->shouldReceive('call')
            ->once()
            ->with($id, $issue)
            ->andReturn($data);

        $returnArray = $this->api->fromIssue($id, $issue);
        $this->assertEquals($data, $returnArray);
    }
}

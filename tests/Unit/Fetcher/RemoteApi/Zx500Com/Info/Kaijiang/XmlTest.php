<?php

namespace Tests\Unit\Fetcher\RemoteApi\Zx500Com\Info\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\Zx500Com\Info\Kaijiang\Xml;
use GyTreasure\Fetcher\RemoteApi\Zx500Com\XmlRequest;
use Mockery;
use PHPUnit\Framework\TestCase;

class XmlTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\Zx500Com\XmlRequest
     */
    protected $xmlRequestMock;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Zx500Com\Info\Kaijiang\Xml
     */
    protected $xml;

    public function setUp()
    {
        parent::setUp();

        $this->xmlRequestMock = Mockery::mock(XmlRequest::class);
        $this->xml            = new Xml($this->xmlRequestMock);
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $id     = 'sd';
        $issue  = '2017188';

        $xml    = '<xml><PeriodicalNO>2017188</PeriodicalNO><Result>7,4,1</Result></xml>';

        $this->xmlRequestMock
            ->shouldReceive('call')
            ->once()
            ->with('static/info/kaijiang/xml/sd/2017188.xml')
            ->andReturn(simplexml_load_string($xml));

        $returnValue = $this->xml->call($id, $issue);
        $this->assertEquals(['7', '4', '1'], $returnValue);
    }
}

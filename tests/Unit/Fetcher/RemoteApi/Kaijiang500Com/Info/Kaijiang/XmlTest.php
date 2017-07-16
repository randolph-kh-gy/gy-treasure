<?php

namespace Tests\Unit\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang\Xml;
use GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\XmlRequest;
use Mockery;
use PHPUnit\Framework\TestCase;

class XmlTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\XmlRequest
     */
    protected $xmlRequestMock;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Kaijiang500Com\Info\Kaijiang\Xml
     */
    protected $xml;

    public function __construct()
    {
        $this->xmlRequestMock   = Mockery::mock(XmlRequest::class);
        $this->xml              = new Xml($this->xmlRequestMock);
    }

    public function testCall()
    {
        $id     = 'xjssc';
        $date   = '2017-07-16';

        $xml    = '<xml><row expect="20170716034" opencode="2,5,9,8,3" specail="" opentime="2017-07-16 15:39:00"/>
                    <row expect="20170716033" opencode="2,4,3,6,9" specail="" opentime="2017-07-16 15:29:00"/></xml>';

        $this->xmlRequestMock
            ->shouldReceive('call')
            ->once()
            ->with('static/info/kaijiang/xml/xjssc/20170716.xml')
            ->andReturn(simplexml_load_string($xml));

        $returnArray = $this->xml->call($id, $date);
        $this->assertEquals([[
            'expect'    => '20170716034',
            'opencode'  => ['2', '5', '9', '8', '3'],
        ], [
            'expect'    => '20170716033',
            'opencode'  => ['2', '4', '3', '6', '9'],
        ]], $returnArray);
    }
}

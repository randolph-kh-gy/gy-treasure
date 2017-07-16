<?php

namespace Tests\Unit\Fetcher\RemoteApi\SimpleXml;

use GyTreasure\Fetcher\RemoteApi\SimpleXml\SimpleXmlApiRequest;
use GyTreasure\Fetcher\Request;
use Mockery;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class SimpleXmlApiRequestTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\Request
     */
    protected $requestMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|\GyTreasure\Fetcher\RemoteApi\SimpleXml\SimpleXmlApiRequest
     */
    protected $xmlRequestMock;

    public function setUp()
    {
        parent::setUp();

        $this->requestMock      = Mockery::mock(Request::class);

        $this->xmlRequestMock   = $this->getMockForAbstractClass(
            SimpleXmlApiRequest::class,
            [$this->requestMock]
        );

        $this->xmlRequestMock
            ->expects($this->any())
            ->method('baseUrl')
            ->will($this->returnValue('http://www.test.com/'));
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    /**
     * @expectedException \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiUnreachableException
     */
    public function testApiUnreachableException()
    {
        $path       = 'test.xml';
        $this->requestMock
            ->shouldReceive('get')
            ->once()
            ->with('http://www.test.com/' . $path)
            ->andReturnNull();

        $this->xmlRequestMock->call($path);
    }

    /**
     * @expectedException \GyTreasure\Fetcher\RemoteApi\Exceptions\ApiParseException
     */
    public function testApiParseException()
    {
        $response   = 'invalid XML';
        $path       = 'test.xml';

        $this->requestMock
            ->shouldReceive('get')
            ->once()
            ->with('http://www.test.com/' . $path)
            ->andReturn($response);

        $this->xmlRequestMock->call($path);
    }

    public function testCall()
    {
        $response   = '<?xml version="1.0" encoding="UTF-8"?><xml><doc>test</doc></xml>';
        $path       = 'test.xml';
        $query      = ['abc' => 'def'];

        $this->requestMock
            ->shouldReceive('get')
            ->once()
            ->with('http://www.test.com/' . $path . '?' . http_build_query($query))
            ->andReturn($response);

        $xml = $this->xmlRequestMock->call($path, $query);
        $this->assertInstanceOf(SimpleXMLElement::class, $xml);
    }
}

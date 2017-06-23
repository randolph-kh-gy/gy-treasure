<?php

namespace Tests\Unit\Fetcher\RemoteApi\SimpleJson;

use Mockery;
use PHPUnit\Framework\TestCase;

use GyTreasure\Fetcher\Request;
use GyTreasure\Fetcher\RemoteApi\SimpleJson\SimpleJsonApiRequest;

class SimpleJsonApiRequestTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface
     */
    protected $requestMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $stubApiRequest;

    public function setUp()
    {
        parent::setUp();

        $this->requestMock = Mockery::mock(Request::class);

        /**
         * @var \PHPUnit_Framework_MockObject_MockObject
         */
        $this->stubApiRequest  = $this->getMockForAbstractClass(SimpleJsonApiRequest::class, [$this->requestMock]);

        $this->stubApiRequest
            ->expects($this->any())
            ->method('baseUrl')
            ->will($this->returnValue('http://api.1680210.com/'));
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $path     = 'test/api';
        $data     = ['key' => 'value'];
        $response = json_encode($data);

        $this->requestMock
            ->shouldReceive('get')
            ->once()
            ->with($this->stubApiRequest->apiUrl($path))
            ->andReturn($response);

        $returnValue = $this->stubApiRequest->call($path);

        $this->assertEquals($data, $returnValue);

        $path     = 'test/api';
        $query    = ['foo' => 'Hello world!'];
        $data     = ['key' => 'value'];
        $response = json_encode($data);

        $this->requestMock
            ->shouldReceive('get')
            ->once()
            ->with($this->stubApiRequest->apiUrl($path, $query))
            ->andReturn($response);

        $returnValue = $this->stubApiRequest->call($path, $query);

        $this->assertEquals($data, $returnValue);
    }
}
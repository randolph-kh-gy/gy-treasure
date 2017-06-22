<?php

namespace Tests\Unit\Fetcher\RemoteApi\Old1680210Com;

use Mockery;
use PHPUnit\Framework\TestCase;

use GyTreasure\Fetcher\Request;
use GyTreasure\Fetcher\RemoteApi\Old1680210Com\ApiRequest;

class ApiRequestTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface
     */
    protected $requestMock;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Old1680210Com\ApiRequest
     */
    protected $apiRequest;

    public function setUp()
    {
        parent::setUp();

        $this->requestMock = Mockery::mock(Request::class);

        $this->apiRequest  = new ApiRequest($this->requestMock);
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $path     = 'test/api';
        $query    = ['foo' => 'Hello world!'];
        $data     = ['key' => 'value'];
        $response = json_encode($data);

        $this->requestMock
            ->shouldReceive('get')
            ->once()
            ->with($this->apiRequest->apiUrl($path, $query))
            ->andReturn($response);
        
        $returnValue = $this->apiRequest->call($path, $query);

        $this->assertEquals($data, $returnValue);
    }
}
<?php

namespace Tests\Unit\Fetcher\Request;

use Mockery;
use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;
use GyTreasure\Fetcher\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;

class RequestTest extends TestCase
{
    /**
     * @var \GyTreasure\Fetcher\Request
     */
    protected $request;

    /**
     * @var \Mockery\MockInterface
     */
    protected $clientMock;

    public function setUp()
    {
        parent::setUp();

        $this->clientMock  = Mockery::mock(Client::class);

        $this->request     = new Request($this->clientMock);
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testGet()
    {
        $url = 'http://www.test.com/test.json';
        $expects = 'testResponse';

        $this->clientMock
            ->shouldReceive('request')
            ->once()
            ->with('GET', $url)
            ->andReturn($this->mockResponse($expects, $streamMock));

        $returnValue = $this->request->get($url);

        $this->assertEquals($expects, $returnValue);
    }

    protected function mockResponse($response, &$streamMock = null)
    {
        if ($streamMock === null) {
            $streamMock = Mockery::mock(Stream::class)
                ->shouldReceive('__toString')
                ->withNoArgs()
                ->andReturn($response)
                ->getMock();

            $streamMock->shouldReceive('close')->andReturnNull();
        }

        $responseMock = Mockery::mock(Response::class)
            ->shouldReceive('getBody')
            ->withNoArgs()
            ->andReturn($streamMock)
            ->getMock();

        return $responseMock;
    }
}

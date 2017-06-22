<?php

namespace Tests\Fetcher\Request;

use Mockery;
use PHPUnit\Framework\TestCase;

use GuzzleHttp\Client;

class RequestTest extends TestCase
{
    protected $clientMock;

    public function setUp()
    {
        parent::setUp();

        $this->clientMock = Mockery::mock(Client::class);
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testGet()
    {
        $this->assertTrue(true);
    }
}

<?php

namespace Tests\Unit\Fetcher\RemoteApi\Cp360Cn\I;

use GyTreasure\Fetcher\RemoteApi\Cp360Cn\ApiRequest;
use GyTreasure\Fetcher\RemoteApi\Cp360Cn\I\Lotapi;
use Mockery;
use PHPUnit\Framework\TestCase;

class LotapiTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\Cp360Cn\ApiRequest
     */
    protected $apiRequestMock;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\Cp360Cn\I\Lotapi
     */
    protected $lotapi;

    protected function setUp()
    {
        parent::setUp();

        $this->apiRequestMock = Mockery::mock(ApiRequest::class);

        $this->lotapi = new Lotapi($this->apiRequestMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $do     = 'qkjcode';
        $lotID  = '166406';
        $issue  = '2017071047';

        $response = [
            [
                'issue' => '2017071047',
                'code'  => '04 08 10 02 11',
                'dx'    => '3:2',
                'jo'    => 'jo',
            ]
        ];

        $this->apiRequestMock
            ->shouldReceive('call')
            ->once()
            ->with('i/lotapi.html', ['datatype' => 'json'] + compact('do', 'lotID', 'issue'))
            ->andReturn($response);

        $returnArray = $this->lotapi->call($do, $lotID, $issue);
        $this->assertEquals($response, $returnArray);
    }
}
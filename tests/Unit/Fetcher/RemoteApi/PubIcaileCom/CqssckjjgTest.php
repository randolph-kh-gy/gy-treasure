<?php

namespace Tests\Unit\Fetcher\RemoteApi\PubIcaileCom;

use GyTreasure\Fetcher\RemoteApi\PubIcaileCom\ApiRequest;
use GyTreasure\Fetcher\RemoteApi\PubIcaileCom\Cqssckjjg;
use Mockery;
use PHPUnit\Framework\TestCase;

class CqssckjjgTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\PubIcaileCom\ApiRequest
     */
    protected $apiRequestMock;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\PubIcaileCom\Cqssckjjg
     */
    protected $api;

    public function setUp()
    {
        parent::setUp();

        $this->apiRequestMock   = Mockery::mock(ApiRequest::class);

        $this->api              = new Cqssckjjg($this->apiRequestMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $action = 'chart';
        $date   = 'yesterday';

        $this->apiRequestMock
            ->shouldReceive('call')
            ->once()
            ->with('cqssckjjg.php', [
                'action' => 'chart',
                'date'   => 'yesterday',
                'id'     => 503,
                'async'  => 'true',
            ])
            ->andReturn($this->_data());

        $data = $this->api->call($action, $date);

        $this->assertEquals(3, count($data));

        $first = $data[0];
        $this->assertEquals('20170711062', $first['dateNumber']);
        $this->assertEquals(['3','0','0','1','3'], $first['list']);
    }

    private function _data()
    {
        return array (
            'errorCode' => 0,
            'data' =>
                array (
                    array (
                        'dateNumber' => '20170711062',
                        'id' => '503',
                        'dateTime' => '2017-07-11 16:20:00',
                        'list' =>
                            array (
                                0 => '3',
                                1 => '0',
                                2 => '0',
                                3 => '1',
                                4 => '3',
                            ),
                    ),
                    array (
                        'dateNumber' => '20170711061',
                        'id' => '503',
                        'dateTime' => '2017-07-11 16:10:00',
                        'list' =>
                            array (
                                0 => '6',
                                1 => '1',
                                2 => '3',
                                3 => '3',
                                4 => '6',
                            ),
                    ),
                    array (
                        'dateNumber' => '20170711060',
                        'id' => '503',
                        'dateTime' => '2017-07-11 16:00:00',
                        'list' =>
                            array (
                                0 => '0',
                                1 => '0',
                                2 => '3',
                                3 => '8',
                                4 => '6',
                            ),
                    ),
                ),
        );
    }
}
<?php

namespace Tests\Unit\ApiFacades\RemoteApi\Cp360Cn;

use GyTreasure\ApiFacades\RemoteApi\Cp360Cn\DrawNumbers;
use GyTreasure\Fetcher\RemoteApi\Cp360Cn\I\Lotapi;
use Mockery;
use PHPUnit\Framework\TestCase;

class DrawNumbersTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\Cp360Cn\I\Lotapi
     */
    protected $lotapiMock;

    /**
     * @var \GyTreasure\ApiFacades\RemoteApi\Cp360Cn\DrawNumbers
     */
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        $this->lotapiMock   = Mockery::mock(Lotapi::class);

        $this->api          = new DrawNumbers($this->lotapiMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testFromIssue()
    {
        $id     = '166406';
        $issue  = '2017071050';

        $data = [
            [
                'issue' => '2017071050',
                'code'  => '05 02 08 11 07',
                'dx'    => '3:2',
                'jo'    => '3:2',
            ],
        ];

        $this->lotapiMock
            ->shouldReceive('call')
            ->once()
            ->with('qkjcode', $id, $issue)
            ->andReturn($data);

        $returnArray = $this->api->fromIssue($id, $issue);

        $expects = ['05', '02', '08', '11', '07'];
        $this->assertEquals($expects, $returnArray);

        // 测试无效奖期
        $issue = 'invalid';

        $data = [
            [
                'code'  => '',
                'issue' => 'invalid'
            ]
        ];

        $this->lotapiMock
            ->shouldReceive('call')
            ->once()
            ->with('qkjcode', $id, $issue)
            ->andReturn($data);

        $returnArray = $this->api->fromIssue($id, $issue);

        $this->assertNull($returnArray);
    }
}

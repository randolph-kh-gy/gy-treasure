<?php

namespace Tests\Unit\ApiFacades\RemoteApi\BwlcGovCn;

use GyTreasure\ApiFacades\RemoteApi\BwlcGovCn\DrawNumbers;
use GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\Prevtrax;
use Mockery;
use PHPUnit\Framework\TestCase;

class DrawNumbersTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\Prevtrax
     */
    protected $prevtraxMock;

    /**
     * @var \GyTreasure\ApiFacades\RemoteApi\BwlcGovCn\DrawNumbers
     */
    protected $api;

    public function setUp()
    {
        parent::setUp();

        $this->prevtraxMock = Mockery::mock(Prevtrax::class);

        $this->api = new DrawNumbers($this->prevtraxMock);
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testDrawLatestGroupIssues()
    {
        $id     = 'trax';
        $data   = $this->data();

        $this->prevtraxMock
            ->shouldReceive('call')
            ->once()
            ->withNoArgs()
            ->andReturn($data);

        $returnArray = $this->api->drawLatestGroupIssues($id);

        $this->assertEquals($data, $returnArray);
    }

    public function testFromIssue()
    {
        $id     = 'trax';
        $issue  = '628142';

        $winningNumbers = ['06', '09', '03', '01', '05', '10', '02', '07', '08', '04'];
        $data = [
            'winningNumbers' => $winningNumbers,
            'issue' => '628142',
        ];

        $this->prevtraxMock
            ->shouldReceive('call')
            ->once()
            ->with($issue)
            ->andReturn([$data]);

        $returnArray = $this->api->fromIssue($id, $issue);

        $this->assertEquals($winningNumbers, $returnArray);

        // 若沒有資料
        $issue = 'invalid';

        $this->prevtraxMock
            ->shouldReceive('call')
            ->once()
            ->with($issue)
            ->andreturn([]);

        $returnArray = $this->api->fromIssue($id, $issue);

        $this->assertNull($returnArray);
    }

    protected function data()
    {
        return [
            [
                'winningNumbers' => ['03', '04', '10', '05', '08', '09', '01', '07', '06', '02'],
                'issue' => '627923',
            ],
            [
                'winningNumbers' => ['01', '02', '10', '05', '06', '08', '09', '07', '04', '03'],
                'issue' => '627922',
            ],
            [
                'winningNumbers' => ['04', '07', '10', '09', '02', '03', '01', '06', '08', '05'],
                'issue' => '627921',
            ],
        ];
    }
}
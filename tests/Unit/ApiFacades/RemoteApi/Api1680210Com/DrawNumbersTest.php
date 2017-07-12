<?php

namespace Tests\Unit\ApiFacades\RemoteApi\Api1680210Com;

use Carbon\Carbon;
use Mockery;
use PHPUnit\Framework\TestCase;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiResponse;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiBusiness;
use GyTreasure\ApiFacades\RemoteApi\Api1680210Com\DrawNumbers;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCai;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCaiList;

class DrawNumbersTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCai
     */
    protected $apiBaseCQShiCaiMock;

    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\Api1680210Com\CQShiCai\GetBaseCQShiCaiList
     */
    protected $apiBaseCQShiCaiListMock;

    /**
     * @var \GyTreasure\ApiFacades\RemoteApi\Api1680210Com\DrawNumbers
     */
    protected $drawNumbers;

    public function setUp()
    {
        parent::setUp();

        $this->apiBaseCQShiCaiMock      = Mockery::mock(GetBaseCQShiCai::class);

        $this->apiBaseCQShiCaiListMock  = Mockery::mock(GetBaseCQShiCaiList::class);

        $this->drawNumbers              = new DrawNumbers($this->apiBaseCQShiCaiMock, $this->apiBaseCQShiCaiListMock);
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCurrentIssue()
    {
        $id = rand(1000, 100000);
        $issue = date('Ymd') . sprintf('%03d', rand(1, 999));

        $this->apiBaseCQShiCaiMock
            ->shouldReceive('call')
            ->once()
            ->with('', $id)
            ->andReturn($this->apiBusiness(['preDrawIssue' => $issue]));

        $returnValue = $this->drawNumbers->currentIssue($id);

        $this->assertEquals($issue, $returnValue);
    }

    public function testDrawLatestGroupIssues()
    {
        $id      = rand(1000, 100000);
        $data    = [];
        $expects = [];
        for ($i = 0; $i < 15; $i++) {
            $row       = $this->_generate();
            $expects[] = $this->_expects($row);
            $data[]    = $row;
        }

        $this->apiBaseCQShiCaiListMock
            ->shouldReceive('call')
            ->once()
            ->with($id)
            ->andReturn($this->apiBusiness($data));

        $returnArray = $this->drawNumbers->drawLatestGroupIssues($id);

        $this->assertEquals($expects, $returnArray);
    }

    public function testDrawDateGroupIssues()
    {
        $id      = rand(1000, 100000);
        $data    = [];
        $expects = [];
        $date    = '2017-07-11';
        for ($i = 0; $i < 15; $i++) {
            $row       = $this->_generate();
            $expects[] = $this->_expects($row);
            $data[]    = $row;
        }

        $this->apiBaseCQShiCaiListMock
            ->shouldReceive('call')
            ->once()
            ->with($id, $date)
            ->andReturn($this->apiBusiness($data));

        $returnArray = $this->drawNumbers->drawDateGroupIssues($id, new Carbon($date));

        $this->assertEquals($expects, $returnArray);
    }

    protected function apiBusiness($data)
    {
        return new ApiBusiness(new ApiResponse('操作成功', [
            'businessCode' => 0,
            'data'         => $data,
            'message'      => '操作成功',
        ]));
    }

    protected function _expects($row)
    {
        return [
            'winningNumbers' => explode(',', $row['preDrawCode']),
            'issue' => $row['preDrawIssue'],
        ];
    }

    protected function _generate()
    {
        $winningNumbers = [];
        for ($i = 0; $i < 5; $i++) {
            $winningNumbers[] = rand(0, 9);
        }

        $issue = date('Ymd') . sprintf('%03d', rand(1, 999));

        return [
            'preDrawCode'  => implode(',', $winningNumbers),
            'preDrawIssue' => $issue,
        ];
    }
}
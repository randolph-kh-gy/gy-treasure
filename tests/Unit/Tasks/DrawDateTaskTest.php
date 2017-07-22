<?php

namespace Tests\Unit\Tasks;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssuesWeakPerformance;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssuesNum;
use GyTreasure\ApiFacades\Interfaces\ApiDrawLatestGroupIssuesNumLess;
use GyTreasure\ApiFacades\Interfaces\ApiDrawRangeIssues;
use GyTreasure\ApiFacades\Interfaces\ApiFromIssue;
use GyTreasure\Tasks\DrawDateTask;
use GyTreasure\Tasks\Task;
use Mockery;
use PHPUnit\Framework\TestCase;

class DrawDateTaskTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Tasks\Task
     */
    protected $taskHandlerMock;

    /**
     * @var \GyTreasure\Tasks\DrawDateTask
     */
    protected $task;

    protected function setUp()
    {
        parent::setUp();

        $this->taskHandlerMock  = Mockery::mock(Task::class);
        $this->task             = new DrawDateTask($this->taskHandlerMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testApiDrawDateGroupIssuesStrategy()
    {
        $apiMock    = Mockery::mock(ApiDrawDateGroupIssues::class);

        $id         = '10002';
        $data       = [[
            'winningNumbers' => ['8', '8', '8', '5', '9'],
            'issue' => '20170719-001',
        ]];
        $date       = new Carbon('2017-07-19');

        $this->taskHandlerMock
            ->shouldReceive('call')
            ->once()
            ->andReturnUsing(function ($api, $callback) use ($apiMock, $id) {
                $info = compact('id');
                return call_user_func_array($callback, [$apiMock, $info]);
            });

        $apiMock
            ->shouldReceive('drawDateGroupIssues')
            ->once()
            ->with($id, $date)
            ->andReturn($data);

        $returnArray = $this->task->apiDrawDateGroupIssuesStrategy($date);
        $this->assertEquals($data, $returnArray);
    }

    public function testApiDrawRangeIssuesStrategy()
    {
        $apiMock    = Mockery::mock(ApiDrawRangeIssues::class);

        $id         = '10002';
        $data       = [[
            'winningNumbers' => ['8', '8', '8', '5', '9'],
            'issue' => '20170719-001',
        ]];

        $expects = [
            '20170719-002',
            '20170719-004',
            '20170719-001',
            '20170719-003',
        ];

        $this->taskHandlerMock
            ->shouldReceive('call')
            ->once()
            ->andReturnUsing(function ($api, $callback) use ($apiMock, $id) {
                $info = compact('id');
                return call_user_func_array($callback, [$apiMock, $info]);
            });

        $apiMock
            ->shouldReceive('drawRangeIssues')
            ->once()
            ->with($id, '20170719-001', '20170719-004')
            ->andReturn($data);

        $returnArray = $this->task->apiDrawRangeIssuesStrategy($expects);
        $this->assertEquals($data, $returnArray);
    }

    public function testApiDrawDateGroupIssuesWeakPerformanceStrategy()
    {
        $apiMock    = Mockery::mock(ApiDrawDateGroupIssuesWeakPerformance::class);

        $id         = '10002';
        $data       = [[
            'winningNumbers' => ['8', '8', '8', '5', '9'],
            'issue' => '20170719-001',
        ]];
        $date       = new Carbon('2017-07-19');

        $this->taskHandlerMock
            ->shouldReceive('call')
            ->once()
            ->andReturnUsing(function ($api, $callback) use ($apiMock, $id) {
                $info = compact('id');
                return call_user_func_array($callback, [$apiMock, $info]);
            });

        $apiMock
            ->shouldReceive('drawDateGroupIssues')
            ->once()
            ->with($id, $date)
            ->andReturn($data);

        $returnArray = $this->task->apiDrawDateGroupIssuesWeakPerformanceStrategy($date);
        $this->assertEquals($data, $returnArray);
    }

    public function testApiDrawLatestGroupIssuesNumStrategy()
    {
        $apiMock    = Mockery::mock(ApiDrawLatestGroupIssuesNum::class);

        $id         = '10002';
        $data       = [[
            'winningNumbers' => ['8', '8', '8', '5', '9'],
            'issue' => '20170719-001',
        ]];

        $expects = [
            '20170719-002',
            '20170719-004',
            '20170719-001',
            '20170719-003',
        ];

        $this->taskHandlerMock
            ->shouldReceive('call')
            ->once()
            ->andReturnUsing(function ($api, $callback) use ($apiMock, $id) {
                $info = compact('id');
                return call_user_func_array($callback, [$apiMock, $info]);
            });

        $apiMock
            ->shouldReceive('drawLatestGroupIssuesNum')
            ->once()
            ->with($id, count($expects))
            ->andReturn($data);

        $returnArray = $this->task->apiDrawLatestGroupIssuesNumStrategy($expects);
        $this->assertEquals($data, $returnArray);
    }

    public function testApiDrawLatestGroupIssuesStrategy()
    {
        $apiMock    = Mockery::mock(ApiDrawLatestGroupIssues::class);

        $id         = '10002';
        $data       = [[
            'winningNumbers' => ['8', '8', '8', '5', '9'],
            'issue' => '20170719-001',
        ]];

        $this->taskHandlerMock
            ->shouldReceive('call')
            ->once()
            ->andReturnUsing(function ($api, $callback) use ($apiMock, $id) {
                $info = compact('id');
                return call_user_func_array($callback, [$apiMock, $info]);
            });

        $apiMock
            ->shouldReceive('drawLatestGroupIssues')
            ->once()
            ->with($id)
            ->andReturn($data);

        $returnArray = $this->task->apiDrawLatestGroupIssuesStrategy();
        $this->assertEquals($data, $returnArray);
    }

    public function testApiDrawLatestGroupIssuesNumLessStrategy()
    {
        $apiMock    = Mockery::mock(ApiDrawLatestGroupIssuesNumLess::class);

        $id         = '10002';
        $data       = [[
            'winningNumbers' => ['8', '8', '8', '5', '9'],
            'issue' => '20170719-001',
        ]];

        $expects = [
            '20170719-002',
            '20170719-004',
            '20170719-001',
            '20170719-003',
        ];

        $this->taskHandlerMock
            ->shouldReceive('call')
            ->once()
            ->andReturnUsing(function ($api, $callback) use ($apiMock, $id) {
                $info = compact('id');
                return call_user_func_array($callback, [$apiMock, $info]);
            });

        $apiMock
            ->shouldReceive('drawLatestGroupIssuesNum')
            ->once()
            ->with($id, count($expects))
            ->andReturn($data);

        $returnArray = $this->task->apiDrawLatestGroupIssuesNumLessStrategy($expects);
        $this->assertEquals($data, $returnArray);
    }

    public function testApiFromIssueStrategy()
    {
        $apiMock    = Mockery::mock(ApiFromIssue::class);

        $id         = '10002';
        $data       = [
            [
                'winningNumbers' => ['3', '6', '5', '8', '2'],
                'issue' => ['20170720-001'],
            ],
            [
                'winningNumbers' => ['0', '9', '1', '2', '3'],
                'issue' => ['20170720-002'],
            ],
            [
                'winningNumbers' => ['0', '0', '4', '4', '2'],
                'issue' => ['20170720-003'],
            ],
        ];

        $this->taskHandlerMock
            ->shouldReceive('call')
            ->times(count($data))
            ->andReturnUsing(function ($api, $callback) use ($apiMock, $id) {
                $info = compact('id');
                return call_user_func_array($callback, [$apiMock, $info]);
            });

        foreach ($data as $row) {
            $apiMock
                ->shouldReceive('fromIssue')
                ->once()
                ->with($id, $row['issue'])
                ->andReturn($row['winningNumbers']);
        }

        $returnArray = $this->task->apiFromIssueStrategy(array_column($data, 'issue'));
        $this->assertEquals($data, $returnArray);
    }
}

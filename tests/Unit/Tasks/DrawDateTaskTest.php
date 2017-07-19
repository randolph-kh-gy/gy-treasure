<?php

namespace Tests\Unit\Tasks;

use Carbon\Carbon;
use GyTreasure\ApiFacades\Interfaces\ApiDrawDateGroupIssues;
use GyTreasure\ApiFacades\Interfaces\ApiDrawRangeIssues;
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
}

<?php

namespace Tests\Unit\Issue\IssueGenerator\LegacyIssueRules;

use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSet;
use GyTreasure\Issue\IssueGenerator\LegacyIssueRules\IssueSetCollection;
use PHPUnit\Framework\TestCase;

class IssueSetCollectionTest extends TestCase
{
    public function testSortMe()
    {
        $issueset = (new IssueSetCollection([
            new IssueSet(['sort' => 3, 'status' => 1, 'cycle' => 300, 'starttime' => '23:00:00', 'endtime' => '23:59:59']),
            new IssueSet(['sort' => 1, 'status' => 1, 'cycle' => 100, 'starttime' => '00:00:00', 'endtime' => '11:00:00']),
            new IssueSet(['sort' => 2, 'status' => 1, 'cycle' => 200, 'starttime' => '12:00:00', 'endtime' => '20:00:00']),
        ]))->sortMe();

        // 取得第一个项目
        $first = $issueset->get(0);
        $firstData = [
            'sort'      => $first->get('sort'),
            'cycle'     => $first->get('cycle'),
            'status'    => $first->get('status'),
            'starttime' => $first->get('starttime'),
            'endtime'   => $first->get('endtime'),
        ];
        $expects = [
            'sort'      => 1,
            'cycle'     => 100,
            'status'    => true,
            'starttime' => [0, 0, 0],
            'endtime'   => [11, 0, 0],
        ];
        $this->assertEquals($expects, $firstData);

        // 取得第二个项目
        $second = $issueset->get(1);
        $secondData = [
            'sort'      => $second->get('sort'),
            'cycle'     => $second->get('cycle'),
            'status'    => $second->get('status'),
            'starttime' => $second->get('starttime'),
            'endtime'   => $second->get('endtime'),
        ];
        $expects = [
            'sort'      => 2,
            'cycle'     => 200,
            'status'    => true,
            'starttime' => [12, 0, 0],
            'endtime'   => [20, 0, 0],
        ];
        $this->assertEquals($expects, $secondData);

        // 取得第三个项目
        $third = $issueset->get(2);
        $thirdData = [
            'sort'      => $third->get('sort'),
            'cycle'     => $third->get('cycle'),
            'status'    => $third->get('status'),
            'starttime' => $third->get('starttime'),
            'endtime'   => $third->get('endtime'),
        ];
        $expects = [
            'sort'      => 3,
            'cycle'     => 300,
            'status'    => true,
            'starttime' => [23, 0, 0],
            'endtime'   => [23, 59, 59],
        ];
        $this->assertEquals($expects, $thirdData);
    }

    public function testAvailable()
    {
        $issueset = (new IssueSetCollection([
            new IssueSet(['sort' => 3, 'status' => 1, 'cycle' => 300, 'starttime' => '23:00:00', 'endtime' => '23:59:59']),
            new IssueSet(['sort' => 1, 'status' => 0, 'cycle' => 100, 'starttime' => '00:00:00', 'endtime' => '11:00:00']),
            new IssueSet(['sort' => 2, 'status' => 1, 'cycle' => 200, 'starttime' => '12:00:00', 'endtime' => '20:00:00']),
        ]))->available();

        $this->assertEquals(2, $issueset->count());

        // 取得第一个项目
        $first = $issueset->get(0);
        $firstData = [
            'sort'      => $first->get('sort'),
            'cycle'     => $first->get('cycle'),
            'status'    => $first->get('status'),
            'starttime' => $first->get('starttime'),
            'endtime'   => $first->get('endtime'),
        ];
        $expects = [
            'sort'      => 3,
            'cycle'     => 300,
            'status'    => true,
            'starttime' => [23, 0, 0],
            'endtime'   => [23, 59, 59],
        ];
        $this->assertEquals($expects, $firstData);

        // 取得第二个项目
        $second = $issueset->get(1);
        $secondData = [
            'sort'      => $second->get('sort'),
            'cycle'     => $second->get('cycle'),
            'status'    => $second->get('status'),
            'starttime' => $second->get('starttime'),
            'endtime'   => $second->get('endtime'),
        ];
        $expects = [
            'sort'      => 2,
            'cycle'     => 200,
            'status'    => true,
            'starttime' => [12, 0, 0],
            'endtime'   => [20, 0, 0],
        ];
        $this->assertEquals($expects, $secondData);
    }

    public function testActivated()
    {
        $issueset = new IssueSetCollection([
            new IssueSet(['sort' => 1, 'status' => 1, 'cycle' => 100, 'starttime' => '00:00:00', 'endtime' => '11:00:00']),
            new IssueSet(['sort' => 2, 'status' => 1, 'cycle' => 200, 'starttime' => '12:00:00', 'endtime' => '20:00:00']),
            new IssueSet(['sort' => 3, 'status' => 1, 'cycle' => 300, 'starttime' => '23:00:00', 'endtime' => '23:59:59']),
        ]);

        $activated = $issueset->activated();
        $activatedData = [
            'sort'      => $activated->get('sort'),
            'cycle'     => $activated->get('cycle'),
            'status'    => $activated->get('status'),
            'starttime' => $activated->get('starttime'),
            'endtime'   => $activated->get('endtime'),
        ];
        $expects = [
            'sort'      => 1,
            'cycle'     => 100,
            'status'    => true,
            'starttime' => [0, 0, 0],
            'endtime'   => [11, 0, 0],
        ];
        $this->assertEquals($expects, $activatedData);

        $issueset->next();

        $activated = $issueset->activated();
        $activatedData = [
            'sort'      => $activated->get('sort'),
            'cycle'     => $activated->get('cycle'),
            'status'    => $activated->get('status'),
            'starttime' => $activated->get('starttime'),
            'endtime'   => $activated->get('endtime'),
        ];
        $expects = [
            'sort'      => 2,
            'cycle'     => 200,
            'status'    => true,
            'starttime' => [12, 0, 0],
            'endtime'   => [20, 0, 0],
        ];
        $this->assertEquals($expects, $activatedData);

        $issueset->next();

        $activated = $issueset->activated();
        $activatedData = [
            'sort'      => $activated->get('sort'),
            'cycle'     => $activated->get('cycle'),
            'status'    => $activated->get('status'),
            'starttime' => $activated->get('starttime'),
            'endtime'   => $activated->get('endtime'),
        ];
        $expects = [
            'sort'      => 3,
            'cycle'     => 300,
            'status'    => true,
            'starttime' => [23, 0, 0],
            'endtime'   => [23, 59, 59],
        ];
        $this->assertEquals($expects, $activatedData);

        $issueset->next();

        $activated = $issueset->activated();
        $this->assertNull($activated);
    }

    public function testNext()
    {
        $issueset = new IssueSetCollection([
            new IssueSet(['sort' => 1, 'status' => 1, 'cycle' => 100, 'starttime' => '00:00:00', 'endtime' => '11:00:00']),
            new IssueSet(['sort' => 2, 'status' => 1, 'cycle' => 200, 'starttime' => '12:00:00', 'endtime' => '20:00:00']),
            new IssueSet(['sort' => 3, 'status' => 1, 'cycle' => 300, 'starttime' => '23:00:00', 'endtime' => '23:59:59']),
        ]);

        $next = $issueset->next()->activated();
        $nextData = [
            'sort'      => $next->get('sort'),
            'cycle'     => $next->get('cycle'),
            'status'    => $next->get('status'),
            'starttime' => $next->get('starttime'),
            'endtime'   => $next->get('endtime'),
        ];
        $expects = [
            'sort'      => 2,
            'cycle'     => 200,
            'status'    => true,
            'starttime' => [12, 0, 0],
            'endtime'   => [20, 0, 0],
        ];
        $this->assertEquals($expects, $nextData);

        $next = $issueset->next()->activated();
        $nextData = [
            'sort'      => $next->get('sort'),
            'cycle'     => $next->get('cycle'),
            'status'    => $next->get('status'),
            'starttime' => $next->get('starttime'),
            'endtime'   => $next->get('endtime'),
        ];
        $expects = [
            'sort'      => 3,
            'cycle'     => 300,
            'status'    => true,
            'starttime' => [23, 0, 0],
            'endtime'   => [23, 59, 59],
        ];
        $this->assertEquals($expects, $nextData);

        $next = $issueset->next()->activated();
        $this->assertNull($next);
    }

    public function testReset()
    {
        $issueset = new IssueSetCollection([
            new IssueSet(['sort' => 1, 'status' => 1, 'cycle' => 100, 'starttime' => '00:00:00', 'endtime' => '11:00:00']),
            new IssueSet(['sort' => 2, 'status' => 1, 'cycle' => 200, 'starttime' => '12:00:00', 'endtime' => '20:00:00']),
            new IssueSet(['sort' => 3, 'status' => 1, 'cycle' => 300, 'starttime' => '23:00:00', 'endtime' => '23:59:59']),
        ]);

        $activated = $issueset->next()->next()->activated();
        $activatedData = [
            'sort'      => $activated->get('sort'),
            'cycle'     => $activated->get('cycle'),
            'status'    => $activated->get('status'),
            'starttime' => $activated->get('starttime'),
            'endtime'   => $activated->get('endtime'),
        ];
        $expects = [
            'sort'      => 3,
            'cycle'     => 300,
            'status'    => true,
            'starttime' => [23, 0, 0],
            'endtime'   => [23, 59, 59],
        ];
        $this->assertEquals($expects, $activatedData);

        $activated = $issueset->reset()->activated();
        $activatedData = [
            'sort'      => $activated->get('sort'),
            'cycle'     => $activated->get('cycle'),
            'status'    => $activated->get('status'),
            'starttime' => $activated->get('starttime'),
            'endtime'   => $activated->get('endtime'),
        ];
        $expects = [
            'sort'      => 1,
            'cycle'     => 100,
            'status'    => true,
            'starttime' => [0, 0, 0],
            'endtime'   => [11, 0, 0],
        ];
        $this->assertEquals($expects, $activatedData);
    }
}

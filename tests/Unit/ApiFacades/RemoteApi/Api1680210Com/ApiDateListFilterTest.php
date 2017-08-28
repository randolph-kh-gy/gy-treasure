<?php

namespace Tests\Unit\ApiFacades\RemoteApi\Api1680210Com;

use Carbon\Carbon;
use GyTreasure\ApiFacades\RemoteApi\Api1680210Com\ApiDateListFilter;

class ApiDateListFilterTest extends \PHPUnit_Framework_TestCase
{
    public function testFilter()
    {
        $array = [
            [
                'preDrawCode'  => '0,9,1',
                'preDrawTime'  => '2017-08-27 21:15:00',
                'preDrawIssue' => 2017232,
            ],
            [
                'preDrawCode'  => '7,4,8',
                'preDrawTime'  => '2017-08-26 21:15:00',
                'preDrawIssue' => 2017231,
            ],
        ];

        $expects = [
            [
                'preDrawCode'  => '0,9,1',
                'preDrawTime'  => '2017-08-27 21:15:00',
                'preDrawIssue' => 2017232,
            ],
        ];

        $filter = new ApiDateListFilter;
        $returnArray = $filter->filter('10041', $array, new Carbon('2017-08-27'));

        $this->assertEquals($expects, $returnArray);
    }
}

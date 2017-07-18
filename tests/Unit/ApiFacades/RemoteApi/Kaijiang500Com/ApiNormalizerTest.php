<?php

namespace Tests\Unit\ApiFacades\RemoteApi\Kaijiang500Com;

use GyTreasure\ApiFacades\RemoteApi\Kaijiang500Com\ApiNormalizer;
use PHPUnit\Framework\TestCase;

class ApiNormalizerTest extends TestCase
{
    /**
     * 重庆时时彩.
     */
    public function testChongqingSsc()
    {
        $id         = 'qihaoxml';
        $issue      = '20170717-001';
        $apiIssue   = '20170717001';

        $returnValue = ApiNormalizer::formatIssue($id, $apiIssue);
        $this->assertEquals($issue, $returnValue);
    }

    /**
     * 十一运夺金
     */
    public function testShiyix5()
    {
        $id         = 'shdsyxw';
        $issue      = '20170711-01';
        $apiIssue   = '170711-01';

        $returnValue = ApiNormalizer::formatIssue($id, $apiIssue);
        $this->assertEquals($issue, $returnValue);
    }
}

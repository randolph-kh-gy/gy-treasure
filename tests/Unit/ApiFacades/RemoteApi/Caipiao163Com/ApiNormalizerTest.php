<?php

namespace Tests\Unit\ApiFacades\RemoteApi\Caipiao163Com;

use GyTreasure\ApiFacades\RemoteApi\Caipiao163Com\ApiNormalizer;
use PHPUnit\Framework\TestCase;

class ApiNormalizerTest extends TestCase
{
    /**
     * 重庆时时彩
     */
    public function testChongqingSsc()
    {
        $id         = 'ssc';
        $issue      = '20170717-001';
        $apiIssue   = '170717001';

        $returnValue = ApiNormalizer::convertIssue($id, $issue);
        $this->assertEquals($apiIssue, $returnValue);

        $returnValue = ApiNormalizer::formatIssue($id, $apiIssue);
        $this->assertEquals($issue, $returnValue);
    }

    /**
     * 十一运夺金
     */
    public function testShiyix5()
    {
        $id         = 'd11';
        $issue      = '20170711-01';
        $apiIssue   = '17071101';

        $returnValue = ApiNormalizer::convertIssue($id, $issue);
        $this->assertEquals($apiIssue, $returnValue);

        $returnValue = ApiNormalizer::formatIssue($id, $apiIssue);
        $this->assertEquals($issue, $returnValue);
    }

    /**
     * 排列3, 体彩P3
     */
    public function testPailie3()
    {
        $id         = 'pl3';
        $issue      = '2017182';
        $apiIssue   = '17182';

        $returnValue = ApiNormalizer::convertIssue($id, $issue);
        $this->assertEquals($apiIssue, $returnValue);

        $returnValue = ApiNormalizer::formatIssue($id, $apiIssue);
        $this->assertEquals($issue, $returnValue);
    }
}
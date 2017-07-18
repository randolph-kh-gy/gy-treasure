<?php

namespace Tests\Unit\ApiFacades\RemoteApi\Zx500Com;

use GyTreasure\ApiFacades\RemoteApi\Zx500Com\ApiNormalizer;
use PHPUnit\Framework\TestCase;

class ApiNormalizerTest extends TestCase
{
    /**
     * 排列3, 体彩P3
     */
    public function testPailie3()
    {
        $id         = 'pls';
        $issue      = '2017001';
        $apiIssue   = '17001';

        $returnValue = ApiNormalizer::convertIssue($id, $issue);
        $this->assertEquals($apiIssue, $returnValue);
    }
}

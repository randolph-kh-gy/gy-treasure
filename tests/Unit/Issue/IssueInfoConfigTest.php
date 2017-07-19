<?php

namespace Tests\Unit\Issue;

use GyTreasure\Issue\IssueInfoConfig;
use PHPUnit\Framework\TestCase;

class IssueInfoConfigTest extends TestCase
{
    public function testGetNull()
    {
        $oldLoader      = IssueInfoConfig::setLoader(function () { return null; });

        $returnValue    = IssueInfoConfig::get('invalid_key');

        $this->assertNull($returnValue);

        IssueInfoConfig::setLoader($oldLoader);
    }

    public function testGet()
    {
        $loader         = $this->loader();
        $oldLoader      = IssueInfoConfig::setLoader($loader);

        $returnArray    = IssueInfoConfig::get('test_key');

        $this->assertSame($loader, IssueInfoConfig::getLoader());
        $this->assertTrue(is_array($returnArray));
        $this->assertArrayHasKey('issuerule', $returnArray);
        $this->assertArrayHasKey('issueset', $returnArray);

        // 复还设定
        IssueInfoConfig::setLoader($oldLoader);
    }

    protected function loader()
    {
        return function ($key) {
            if ($key == 'test_key') {
                return [
                    'issuerule'  => 'Ymd-[n3]|0,1,0',
                    'issueset'   => [
                        [
                            'starttime'     => '00:00:00',
                            'firstendtime'  => '00:05:00',
                            'endtime'       => '01:55:00',
                            'cycle'         => 300,
                            'endsale'       => 35,
                            'inputcodetime' => 30,
                            'droptime'      => 35,
                            'status'        => 1,
                            'sort'          => 0,
                        ]
                    ]
                ];
            }
            return null;
        };
    }
}
<?php

namespace Tests\Unit\Fetcher\RemoteApi;

use PHPUnit\Framework\TestCase;

use GyTreasure\Fetcher\RemoteApi\BaseApiRequest;

class BaseApiRequestTest extends TestCase
{
    protected $stubBaseApiRequest;

    public function setUp()
    {
        parent::setUp();

        $this->stubBaseApiRequest = $this->getMockForAbstractClass(BaseApiRequest::class);
    }

    public function testApiUrl()
    {
        $path    = '/test/\\/api2.do';
        $expects = 'http://api.1680210.com/test/api2.do';

        $this->stubBaseApiRequest
            ->expects($this->any())
            ->method('baseUrl')
            ->will($this->returnValue('http://api.1680210.com/'));

        $returnValue = $this->stubBaseApiRequest->apiUrl($path);

        $this->assertEquals($expects, $returnValue);

        $path    = '/test/\\/api2.do';
        $query   = ['query1' => 'data1', 'query2' => 'data2'];
        $expects = 'http://api.1680210.com/test/api2.do?query1=data1&query2=data2';

        $returnValue = $this->stubBaseApiRequest->apiUrl($path, $query);

        $this->assertEquals($expects, $returnValue);
    }
}

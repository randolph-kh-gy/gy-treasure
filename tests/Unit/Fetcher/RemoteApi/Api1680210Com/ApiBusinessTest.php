<?php

namespace Tests\Unit\Fetcher\RemoteApi\Api1680210Com;

use PHPUnit\Framework\TestCase;

use ArrayIterator;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiResponse;
use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiBusiness;

class ApiBusinessTest extends TestCase
{
    public function testBusiness()
    {
        $businessCode   = 0;
        $message        = 'Business_测试讯息';
        $data           = ['foo' => 'Hello World!'];
        $result         = compact('businessCode', 'message', 'data');

        $apiBusiness    = new ApiBusiness(new ApiResponse('API_测试讯息', $result));

        $this->assertEquals($message, $apiBusiness->getMessage());
        $this->assertEquals($data, $apiBusiness->getData());

        // getIterator
        $iterator = $apiBusiness->getIterator();
        $this->assertEquals(new ArrayIterator($data), $iterator);

        // offsetExists
        $this->assertTrue(isset($apiBusiness['foo']));
        $this->assertFalse(isset($apiBusiness['invalid']));

        // offsetGet
        $this->assertSame($data['foo'], $apiBusiness['foo']);
        $this->assertNull($apiBusiness['invalid']);

        // offsetSet
        $apiBusiness['newKey'] = 'newValue';
        $this->assertEquals('newValue', $apiBusiness['newKey']);

        // offsetUnset
        unset($apiBusiness['newKey']);
        $this->assertNull($apiBusiness['newKey']);
    }
}
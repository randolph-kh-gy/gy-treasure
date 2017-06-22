<?php

namespace Tests\Unit\Fetcher\RemoteApi\Api1680210Com;

use PHPUnit\Framework\TestCase;

use GyTreasure\Fetcher\RemoteApi\Api1680210Com\ApiResponse;

class ApiResponseTest extends TestCase
{
    public function testResponse()
    {
        $message    = '测试讯息';
        $data       = ['key1' => 'value1'];

        $response   = new ApiResponse($message, $data);

        $this->assertSame($message, $response->getMessage());
        $this->assertSame($data, $response->getData());

        $this->assertTrue(isset($response['key1']));
        $this->assertFalse(isset($response['invalid']));

        $this->assertSame($data['key1'], $response['key1']);
        $this->assertNull($response['invalid']);

        $response['key2'] = 'value2';
        $this->assertSame('value2', $response['key2']);

        unset($response['key2']);
        $this->assertNull($response['key2']);
    }

    public function testEqualsCase1()
    {
        $sameData = ['data' => 'whatever!'];

        $response1 = new ApiResponse('same message', $sameData);
        $response2 = new ApiResponse('same message', $sameData);
        $this->assertTrue($response1->equals($response2));

        $response1 = new ApiResponse('message1', $sameData);
        $response2 = new ApiResponse('message2', $sameData);
        $this->assertFalse($response1->equals($response2));
    }

    public function testEqualsCase2()
    {
        $sameMessage = 'same message';

        $response1 = new ApiResponse($sameMessage, ['data' => 'same data']);
        $response2 = new ApiResponse($sameMessage, ['data' => 'same data']);
        $this->assertTrue($response1->equals($response2));

        $response1 = new ApiResponse($sameMessage, ['data' => 'data1']);
        $response2 = new ApiResponse($sameMessage, ['data' => 'data2']);
        $this->assertFalse($response1->equals($response2));
    }
}
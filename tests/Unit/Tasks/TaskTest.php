<?php

namespace Tests\Unit\Tasks;

use GyTreasure\Tasks\Task;
use Mockery;
use PHPUnit\Framework\TestCase;

use Faker;
use GyTreasure\ApiLoader;

class TaskTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\ApiLoader
     */
    protected $apiLoaderMock;

    /**
     * @var \GyTreasure\Tasks\Task
     */
    protected $task;

    public function setUp()
    {
        parent::setUp();

        $this->apiLoaderMock    = Mockery::mock(ApiLoader::class);

        $this->task             = new Task($this->apiLoaderMock);
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testGetApiInstancesCase1()
    {
        $faker     = Faker\Factory::create();
        $apiName   = ucfirst($faker->word);
        $instances = $this->_fakeInstances(3);

        $this->apiLoaderMock
            ->shouldReceive('getInstances')
            ->once()
            ->with($apiName, null)
            ->andReturn($instances);

        $returnArray = $this->task->getApiInstances($apiName);

        $this->assertSame($instances, $returnArray);
    }

    public function testGetApiInstancesCase2()
    {
        $faker     = Faker\Factory::create();
        $apiName   = ucfirst($faker->word);
        $forge     = $faker->word;
        $instances = $this->_fakeInstances(3);

        $this->apiLoaderMock
            ->shouldReceive('getInstances')
            ->once()
            ->with($apiName, $forge)
            ->andReturn($instances);

        $returnArray = $this->task->getApiInstances($apiName, $forge);

        $this->assertSame($instances, $returnArray);
    }

    public function testGetApiInstancesCase3()
    {
        $faker      = Faker\Factory::create();
        $apiName    = ucfirst($faker->word);
        $forge      = $faker->word;
        $instanceof = implode('\\', $faker->words(3));
        $instances  = $this->_fakeInstances(3);

        $this->apiLoaderMock
            ->shouldReceive('getInstances')
            ->once()
            ->with($apiName, $forge, $instanceof)
            ->andReturn($instances);

        $returnArray = $this->task->getApiInstances($apiName, $forge, $instanceof);

        $this->assertSame($instances, $returnArray);
    }

    public function testInfoWithConfigId()
    {
        $faker        = Faker\Factory::create();
        $instanceName = $faker->word;
        $instance     = new \stdClass();
        $id           = $faker->word;
        $identity     = $faker->word;
        $config       = compact('id');

        $this->apiLoaderMock
            ->shouldReceive('instanceName')
            ->once()
            ->with($instance)
            ->andReturn($instanceName);

        $this->apiLoaderMock
            ->shouldReceive('apiConfig')
            ->once()
            ->with($instanceName)
            ->andReturn($config);

        $this->apiLoaderMock
            ->shouldReceive('identity')
            ->once()
            ->withNoArgs()
            ->andReturn($identity);

        $returnValue = $this->task->info($instance);

        $this->assertEquals(compact('instanceName', 'config', 'id'), $returnValue);
    }

    public function testInfoWithoutConfigId()
    {
        $faker        = Faker\Factory::create();
        $instanceName = $faker->word;
        $instance     = new \stdClass();
        $identity     = $id = $faker->word;
        $config       = ['nothing' => $faker->word];

        $this->apiLoaderMock
            ->shouldReceive('instanceName')
            ->once()
            ->with($instance)
            ->andReturn($instanceName);

        $this->apiLoaderMock
            ->shouldReceive('apiConfig')
            ->once()
            ->with($instanceName)
            ->andReturn($config);

        $this->apiLoaderMock
            ->shouldReceive('identity')
            ->once()
            ->withNoArgs()
            ->andReturn($identity);

        $returnValue = $this->task->info($instance);

        $this->assertEquals(compact('instanceName', 'config', 'id'), $returnValue);
    }

    private function _fakeInstances($count)
    {
        $returnArray = [];
        for ($i = 0; $i < $count; $i++) {
            $returnArray[] = new \stdClass();
        }
        return $returnArray;
    }
}

<?php

namespace Tests\Unit\Process;

use Mockery;
use PHPUnit\Framework\TestCase;

use Faker;
use GyTreasure\ApiLoader;
use GyTreasure\Process\ApiStrategy;
use GyTreasure\Process\Process;

class ApiStrategyTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface
     */
    protected $apiLoaderMock;

    /**
     * @var \Mockery\MockInterface
     */
    protected $processMock;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $apiStrategy;

    public function setUp()
    {
        parent::setUp();

        $this->apiLoaderMock = Mockery::mock(ApiLoader::class);

        $this->processMock   = Mockery::mock(Process::class);

        $this->apiStrategy   = $this->getMockForAbstractClass(ApiStrategy::class, [$this->processMock]);

        $this->processMock
            ->shouldReceive('loader')
            ->withNoArgs()
            ->andReturn($this->apiLoaderMock);
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

        $returnArray = $this->apiStrategy->getApiInstances($apiName);

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

        $returnArray = $this->apiStrategy->getApiInstances($apiName, $forge);

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

        $returnArray = $this->apiStrategy->getApiInstances($apiName, $forge, $instanceof);

        $this->assertSame($instances, $returnArray);
    }

    public function testProcess()
    {
        $this->assertSame($this->processMock, $this->apiStrategy->process());
    }

    public function testNext()
    {
        $this->processMock
            ->shouldReceive('setStrategy')
            ->once()
            ->with(Mockery::type(ApiStrategy::class))
            ->andReturnSelf();

        $returnValue = $this->apiStrategy->next(StubApiStrategy::class);

        $this->assertInstanceOf(StubApiStrategy::class, $returnValue);
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

        $returnValue = $this->apiStrategy->info($instance);

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

        $returnValue = $this->apiStrategy->info($instance);

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

class StubApiStrategy extends ApiStrategy
{
}
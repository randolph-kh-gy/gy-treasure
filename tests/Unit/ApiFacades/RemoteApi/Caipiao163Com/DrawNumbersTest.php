<?php

namespace Tests\Unit\ApiFacades\RemoteApi\Caipiao163Com;

use Mockery;
use PHPUnit\Framework\TestCase;

use Faker;
use GyTreasure\ApiFacades\RemoteApi\Caipiao163Com\DrawNumbers;
use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\GetAwardNumberInfo;
use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Order\PreBetPeriodInfoTime;

class DrawNumbersTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface
     */
    protected $apiNumInfoMock;

    /**
     * @var \Mockery\MockInterface
     */
    protected $apiPreMock;

    /**
     * @var \GyTreasure\ApiFacades\RemoteApi\Caipiao163Com\DrawNumbers
     */
    protected $drawNumbers;

    public function setUp()
    {
        parent::setUp();

        $this->apiNumInfoMock   = Mockery::mock(GetAwardNumberInfo::class);
        $this->apiPreMock       = Mockery::mock(PreBetPeriodInfoTime::class);

        $this->drawNumbers      = new DrawNumbers($this->apiNumInfoMock, $this->apiPreMock);
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCurrentIssue()
    {
        $faker  = Faker\Factory::create();
        $id     = $faker->word;
        $issue  = date('ymd') . sprintf('%03d', rand(0, 999));

        $this->apiPreMock
            ->shouldReceive('call')
            ->once()
            ->with(['gameEn' => $id])
            ->andReturn(['currentPeriod' => $issue]);

        $returnValue = $this->drawNumbers->currentIssue($id);

        $this->assertEquals($issue, $returnValue);
    }

    public function testFromIssue()
    {
        $issue      = 'ssc';
        $row        = $this->_generateRows();
        $expects    = $this->_toExpects($row);
        $expects    = $expects['winningNumbers'];

        $data       = [
            'awardNumberInfoList' => [$row],
            'status' => '0',
        ];

        $this->apiNumInfoMock
            ->shouldReceive('call')
            ->once()
            ->with(['gameEn' => $issue, 'period' => $row['period']])
            ->andReturn($data);

        $returnArray = $this->drawNumbers->fromIssue($issue, $row['period']);

        $this->assertEquals($expects, $returnArray);
    }

    public function testDrawLatestGroupIssues()
    {
        $issue      = 'ssc';
        $num        = 15;

        $rows       = [];
        $expects    = [];
        for ($i = 0; $i < $num; $i++) {
            $row        = $this->_generateRows();
            $expects[]  = $this->_toExpects($row);
            $rows[]     = $row;
        }

        $data = [
            'awardNumberInfoList' => $rows,
            'status' => '0',
        ];

        $this->apiNumInfoMock
            ->shouldReceive('call')
            ->once()
            ->with(['gameEn' => $issue, 'periodNum' => $num])
            ->andReturn($data);

        $returnArray = $this->drawNumbers->drawLatestGroupIssuesNum($issue, $num);

        $this->assertEquals($expects, $returnArray);
    }

    protected function _toExpects($data)
    {
        return [
            'winningNumbers' => explode(' ', $data['winningNumber']),
            'issue'          => $data['period'],
        ];
    }

    protected function _generateRows($data = [])
    {
        $faker = Faker\Factory::create();

        $winningNumbers = [];
        for ($i = 0; $i < 5; $i++) {
            $winningNumbers[] = rand(0, 9);
        }

        $fake = [
            'daXiaoBi'      => $faker->word,
            'firstXt'       => $faker->word,
            'geWei'         => $faker->word,
            'hezhi'         => $faker->word,
            'houSan'        => $faker->word,
            'jiOuBi'        => $faker->word,
            'period'        => date('ymd') . sprintf('%03d', rand(0, 999)),
            'secondXt'      => $faker->word,
            'shiWei'        => $faker->word,
            'winningNumber' => implode(' ', $winningNumbers),
            'xingTai'       => $faker->word,
        ];

        return array_merge($fake, $data);
    }
}
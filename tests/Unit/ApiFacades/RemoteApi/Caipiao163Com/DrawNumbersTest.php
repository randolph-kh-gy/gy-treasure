<?php

namespace Tests\ApiFacades\RemoteApi\Caipiao163Com;

use Mockery;
use PHPUnit\Framework\TestCase;

use Faker;
use GyTreasure\ApiFacades\RemoteApi\Caipiao163Com\DrawNumbers;
use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\GetAwardNumberInfo;

class DrawNumbersTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface
     */
    protected $remoteMock;

    /**
     * @var \GyTreasure\ApiFacades\RemoteApi\Caipiao163Com\DrawNumbers
     */
    protected $drawNumbers;

    public function setUp()
    {
        parent::setUp();

        $this->remoteMock  = Mockery::mock(GetAwardNumberInfo::class);

        $this->drawNumbers = new DrawNumbers($this->remoteMock);
    }

    public function tearDown()
    {
        Mockery::close();

        parent::tearDown();
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

        $this->remoteMock
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

        $this->remoteMock
            ->shouldReceive('call')
            ->once()
            ->with(['gameEn' => $issue, 'periodNum' => $num])
            ->andReturn($data);

        $returnArray = $this->drawNumbers->drawLatestGroupIssues($issue, $num);

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
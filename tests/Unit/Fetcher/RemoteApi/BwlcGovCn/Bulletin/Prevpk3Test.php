<?php

namespace Tests\Unit\Fetcher\RemoteApi\BwlcGovCn\Bulletin;

use GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\Prevpk3;
use GyTreasure\Fetcher\RemoteApi\BwlcGovCn\HtmlRequest;
use Mockery;
use PHPUnit\Framework\TestCase;

class Prevpk3Test extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\BwlcGovCn\HtmlRequest
     */
    protected $htmlRequestMock;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\Prevpk3
     */
    protected $prevpk3;

    protected function setUp()
    {
        parent::setUp();

        $this->htmlRequestMock  = Mockery::mock(HtmlRequest::class);

        $this->prevpk3          = new Prevpk3($this->htmlRequestMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $issue = '2017184';
        $page  = 1;

        $this->htmlRequestMock
            ->shouldReceive('call')
            ->once()
            ->with('bulletin/prevpk3.html', [
                'num'   => $issue,
                'page'  => $page,
            ])
            ->andReturn($this->_html());

        $returnArray = $this->prevpk3->call($issue, $page);

        $expects = [
            [
                'winningNumbers' => ['8', '9', '9'],
                'issue' => '2017184',
            ]
        ];

        $this->assertEquals($expects, $returnArray);
    }

    private function _html()
    {
        return '<table class="tb" width="100%">
                    <tr>
                        <th width="20%">期号</th>
                        <th>百位</th>
                        <th>十位</th>
                        <th>个位</th>
                                                    <th width="20%">开奖日期</th>
                        <th width="20%">开奖公告</th>
                    </tr>
                    <tr>
                            <td>2017184</td>
                            <td>8</td>
                            <td>9</td>
                            <td>9</td>
                                                            <td>2017-07-10 00:00:00</td>
                            <td><a href="pk3.html?num=2017184">公告</a></td>
                    </tr>
				</table>';
    }
}
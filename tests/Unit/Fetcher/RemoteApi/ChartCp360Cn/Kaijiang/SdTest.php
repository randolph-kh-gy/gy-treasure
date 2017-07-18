<?php

namespace Tests\Unit\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HtmlRequest;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\Sd;
use Mockery;
use PHPUnit\Framework\TestCase;

class SdTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HtmlRequest
     */
    protected $htmlRequestMock;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\Sd
     */
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        $this->htmlRequestMock = Mockery::mock(HtmlRequest::class);
        $this->api             = new Sd($this->htmlRequestMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $lotId      = '210053';
        $spanType   = '0';
        $span       = '1';

        $this->htmlRequestMock
            ->shouldReceive('call')
            ->once()
            ->with('kaijiang/sd', compact('lotId', 'spanType', 'span'))
            ->andReturn($this->_html());

        $data = $this->api->call($lotId, $spanType, $span);

        $this->assertEquals([[
            'winningNumbers' => ['5', '6', '7'],
            'issue'          => '2017191',
        ]], $data);
    }

    private function _html()
    {
        return '<div class=\'chart-tab\'  id=\'his-tab\'><table width=\'100%\' style=\'display: none; width: 980px; position: absolute; z-index: 123; top: -226px;\'><thead class=\'kaijiang\'><tr><th rowspan=\'2\' width=\'10%\'>期号&nbsp; <a href=\'#\' class=\'tharr tharr-up\'></a></th><th rowspan=\'2\' width=\'10%\'>开奖日期</th><th rowspan=\'2\' width=\'15%\'>开奖号码</th><th rowspan=\'2\' width=\'5%\'>试机号</th><th rowspan=\'2\' width=\'12%\'>投注金额（元）</th><th colspan=\'2\' width=\'12%\'>直选</th><th colspan=\'2\' width=\'12%\'>组三</th><th colspan=\'2\' width=\'12%\'>组六</th><th rowspan=\'2\' width=\'9%\'>360中奖</th></tr><tr><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th></tr></thead></table><table width=\'100%\' class=\'his-table\'><thead class=\'kaijiang\'><tr><th rowspan=\'2\' width=\'10%\'>期号&nbsp; <a href=\'#\' class=\'tharr tharr-up\'></a></th><th rowspan=\'2\' width=\'10%\'>开奖日期</th><th rowspan=\'2\' width=\'15%\'>开奖号码</th><th rowspan=\'2\' width=\'5%\'>试机号</th><th rowspan=\'2\' width=\'12%\'>投注金额（元）</th><th colspan=\'2\' width=\'12%\'>直选</th><th colspan=\'2\' width=\'12%\'>组三</th><th colspan=\'2\' width=\'12%\'>组六</th><th rowspan=\'2\' width=\'9%\'>360中奖</th></tr><tr><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th></tr></thead><tbody id=\'data-tab\'><tr week=\'1\'><td>2017191</td><td>2017-07-17(一)</td><td><span class=\'ball_5\'>5</span>&nbsp;<span class=\'ball_5\'>6</span>&nbsp;<span class=\'ball_5\'>7</span>&nbsp;(组六)<td>137</td><td>39,909,308</td><td>18217</td><td>1,040</td><td>0</td><td>346</td><td>28778</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017191\'>查看统计</a></td></tr></tbody></table></div>';
    }
}

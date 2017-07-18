<?php

namespace Tests\Unit\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HtmlRequest;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\P3;
use Mockery;
use PHPUnit\Framework\TestCase;

class P3Test extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HtmlRequest
     */
    protected $htmlRequestMock;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\P3
     */
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        $this->htmlRequestMock = Mockery::mock(HtmlRequest::class);
        $this->api             = new P3($this->htmlRequestMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $lotId      = '110033';
        $spanType   = '0';
        $span       = '1';

        $this->htmlRequestMock
            ->shouldReceive('call')
            ->once()
            ->with('kaijiang/p3', compact('lotId', 'spanType', 'span'))
            ->andReturn($this->_html());

        $data = $this->api->call($lotId, $spanType, $span);

        $this->assertEquals([[
            'winningNumbers' => ['9', '7', '8'],
            'issue'          => '2017191',
        ]], $data);
    }

    private function _html()
    {
        return '<div class=\'chart-tab\'  id=\'his-tab\'><table width=\'100%\' style=\'display: none; width: 980px; position: absolute; z-index: 123; top: -226px;\'><thead class=\'kaijiang\'><tr><th rowspan=\'2\' width=\'10%\'>期号&nbsp; <a href=\'#\' class=\'tharr tharr-up\'></a></th><th rowspan=\'2\' width=\'10%\'>开奖日期</th><th rowspan=\'2\' width=\'18%\'>开奖号码</th><th rowspan=\'2\' width=\'10%\'>投注金额（元）</th><th colspan=\'2\' width=\'15%\'>直选</th><th colspan=\'2\' width=\'15%\'>组三</th><th colspan=\'2\' width=\'14%\'>组六</th><th rowspan=\'2\' width=\'8%\'>360中奖</th></tr><tr><th width=\'6%\'>注数</th><th width=\'9%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'9%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'8%\'>奖金（元）</th></tr></thead></table><table width=\'100%\' class=\'his-table\'><thead class=\'kaijiang\'><tr><th rowspan=\'2\' width=\'10%\'>期号&nbsp; <a href=\'#\' class=\'tharr tharr-up\'></a></th><th rowspan=\'2\' width=\'10%\'>开奖日期</th><th rowspan=\'2\' width=\'18%\'>开奖号码</th><th rowspan=\'2\' width=\'10%\'>投注金额（元）</th><th colspan=\'2\' width=\'15%\'>直选</th><th colspan=\'2\' width=\'15%\'>组三</th><th colspan=\'2\' width=\'14%\'>组六</th><th rowspan=\'2\' width=\'8%\'>360中奖</th></tr><tr><th width=\'6%\'>注数</th><th width=\'9%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'9%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'8%\'>奖金（元）</th></tr></thead><tbody id=\'data-tab\'><tr week=\'1\'><td>2017191</td><td>2017-07-17(一)</td><td><span class=\'ball_5\'>9</span>&nbsp;<span class=\'ball_5\'>7</span>&nbsp;<span class=\'ball_5\'>8</span>&nbsp;(组六)</td><td>14,013,240</td><td>2780</td><td>1,040</td><td>0</td><td>346</td><td>7214</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/p3?Issue=2017191\'>查看统计</a></td></tr></tbody></table></div>';
    }
}

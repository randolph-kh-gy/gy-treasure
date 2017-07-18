<?php

namespace Tests\Unit\Fetcher\RemoteApi\ChartCp360Cn\Zst;

use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HtmlRequest;
use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Zst\Syy;
use Mockery;
use PHPUnit\Framework\TestCase;

class SyyTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\HtmlRequest
     */
    protected $htmlRequestMock;

    /**
     * @var \GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Zst\Syy
     */
    protected $api;

    protected function setUp()
    {
        parent::setUp();

        $this->htmlRequestMock = Mockery::mock(HtmlRequest::class);
        $this->api             = new Syy($this->htmlRequestMock);
    }

    protected function tearDown()
    {
        Mockery::close();

        parent::tearDown();
    }

    public function testCall()
    {
        $lotId      = '166406';
        $chartType  = 'rxfb';
        $spanType   = '0';
        $span       = '1';

        $this->htmlRequestMock
            ->shouldReceive('call')
            ->once()
            ->with('zst/syy', compact('lotId', 'chartType', 'spanType', 'span'))
            ->andReturn($this->_html());

        $data = $this->api->call($lotId, $spanType, $span);

        $this->assertEquals([[
            'winningNumbers' => ['03', '09', '02', '01', '07'],
            'issue'          => '20170718-43',
        ]], $data);
    }

    private function _html()
    {
        return '<div class=\'chart-nav2\' lot=\'166406\' ct=\'rxfb\'><ul><li><span>任选:</span><a href=\'/zst/getchartdata?lotId=166406&chartType=rxfb\' class=\'cur\'>号码分布<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=rxdx\' class=\'\'>大小<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=rxjo\' class=\'\'>奇偶<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=rxzh\' class=\'\'>质合<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=rxkd\' class=\'\'>跨度<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=rxhz\' class=\'\'>和值<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=rx012\' class=\'\'>012路<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=rxpj\' class=\'\'>平均值<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=rxspj\' class=\'\'>升平降<em></em></a></li><li><span>前二:</span><a href=\'/zst/getchartdata?lotId=166406&chartType=q2zhx\' class=\'\'>直选<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q2zx\' class=\'\'>组选<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q2kd\' class=\'\'>跨度<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q2hz\' class=\'\'>和值<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q2012\' class=\'\'>012路<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q2pj\' class=\'\'>平均值<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q2spj\' class=\'\'>升平降<em></em></a></li><li><span>定位:</span><a href=\'/zst/getchartdata?lotId=166406&chartType=dww1\' class=\'\'>第一位(前一)<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=dww2\' class=\'\'>第二位<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=dww3\' class=\'\'>第三位<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=dww4\' class=\'\'>第四位<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=dww5\' class=\'\'>第五位<em></em></a></li><li><span>前三:</span><a href=\'/zst/getchartdata?lotId=166406&chartType=q3zhx\' class=\'\'>直选<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q3zx\' class=\'\'>组选<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q3kd\' class=\'\'>跨度<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q3hz\' class=\'\'>和值<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q3012\' class=\'\'>012路<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q3pj\' class=\'\'>平均值<em></em></a>|<a href=\'/zst/getchartdata?lotId=166406&chartType=q3spj\' class=\'\'>升平降<em></em></a></li</ul></div><div class=\'chart-sc\'><ul> <li><strong>查询：</strong></li><li><a href=\'#\' class=\'btn-sc\'>近30期</a></li><li><a href=\'#\' class=\'btn-sc\'>近50期</a></li><li><a href=\'#\' class=\'btn-sc\'>近100期</a></li><li><a href=\'#\' class=\'btn-sc\'>今天</a></li><li><a href=\'#\' class=\'btn-sc\'>近3天</a></li><li><div class=\'zdy\'><a href=\'#\' class=\'zdy-btn zdy-btn-cur\'>自定义查询<em></em></a><div class=\'zdy-pop\' style=\'display:none;\'> <div class=\'zdy-tag\'><a href=\'#\' class=\'cur\'>按期数</a><a href=\'#\'>按天数</a> <a class=\'close\'>关闭</a> </div> <div class=\'zdy-cnt\'> <div class=\'byIssueNum\'><p>我要查询最近&nbsp;<input type=\'text\' class=\'ipt-sc issueNum\'/>&nbsp;期</p><span class=\'sTip\'>注：最多仅限查询1500期数据。</span></div><div class=\'byDay\' style=\'display:none;\'><p>从<span class=\'byDate\'><input type=\'text\' class=\'ipt-sc\' id=\'dateFrom\' readonly=\'\'/></span>&nbsp;至&nbsp;<span class=\'byDate\'><input type=\'text\' class=\'ipt-sc\' id=\'dateTo\' readonly=\'\'/></span></p></div><p> <button class=\'btn-star\'>开始查询</button> <button class=\'btn-rst\'>重 置</button> </p></div> </div> </div> </li> <li><div class=\'draw\'> <a href=\'#\' class=\'draw-btn\'>绘图工具</a><div class=\'draw-pop\' style=\'display:none;\' shape=\'0\'><a href=\'#nogo\' class=\'tool-square on\' title=\'方框\' val=\'0\'></a><a href=\'#nogo\' class=\'tool-circle\' title=\'圆\' val=\'4\'></a><a href=\'#nogo\' class=\'tool-line\' title=\'直线\' val=\'1\'></a><a href=\'#nogo\' class=\'tool-curve\' title=\'曲线\' val=\'3\'></a><a href=\'#\' class=\'tool-clear\' title=\'清除\'></a><a href=\'#nogo\' class=\'tool-back\' title=\'橡皮檫\' val=\'2\'><a href=\'#nogo\' class=\'tool-cls\' title=\'关闭\'></a></div> </div> </li> </ul><strong>标注：</strong><label><input type=\'checkbox\' name=\'options\' val=\'sj\' />&nbsp;遗漏数据&nbsp;</label><label><input type=\'checkbox\' name=\'options\' val=\'fc\' checked=\'checked\'/>&nbsp;遗漏分层&nbsp;</label><label><input type=\'checkbox\' name=\'options\' val=\'zx\' checked=\'checked\'/>&nbsp;折线&nbsp;</label><label><input type=\'checkbox\' name=\'options\' val=\'lh\' />&nbsp;邻号&nbsp;</label><label><input type=\'checkbox\' name=\'options\' val=\'ch\' />&nbsp;重号&nbsp;</label><label><input type=\'checkbox\' name=\'options\' val=\'lx\' />&nbsp;连号&nbsp;</label></div><div class=\'chart-tab nonum\' id=\'chart-tab\'><table width=\'100%\' class=\'chart-table\'><thead class=\'rxfb\'><tr><th rowspan=\'2\' class=\'w90\'>期号&nbsp; <a href=\'#\' class=\'tharr tharr-up\'></a></th><td rowspan=\'2\' class=\'tdbdr \'></td><th rowspan=\'2\' class=\'w126\'>奖号</th><td rowspan=\'2\' class=\'tdbdr \'></td><th rowspan=\'2\' class=\'w28\'>和值</th><td rowspan=\'2\' class=\'tdbdr \'></td><th rowspan=\'2\' class=\'w28\'>跨度</th><td rowspan=\'2\' class=\'tdbdr \'></td><th colspan=\'12\' class=\'noth \'>基本号码</th><td class=\'tdbdr \'></td><th colspan=\'6\' class=\'noth tshow\'>大号个数/<a href=\'#\'>小号</a></th><td class=\'tdbdr \'></td><th colspan=\'6\' class=\'noth thide\'>小号个数/<a href=\'#\'>大号</a></th><td class=\'tdbdr thide\'></td><th colspan=\'6\' class=\'noth tshow\'>奇号个数/<a href=\'#\'>偶号</a></th><td class=\'tdbdr \'></td><th colspan=\'6\' class=\'noth thide\'>偶号个数/<a href=\'#\'>奇号</a></th><td class=\'tdbdr thide\'></td><th colspan=\'6\' class=\'noth tshow\'>质数个数/<a href=\'#\'>合数</a></th><th colspan=\'6\' class=\'noth thide\'>合数个数/<a href=\'#\'>质数</a></th></tr><tr><td class=\' \'>01</td><td class=\' \'>02</td><td class=\' \'>03</td><td class=\' \'>04</td><td class=\' \'>05</td><td class=\'tdbdr \'></td><td class=\' \'>06</td><td class=\' \'>07</td><td class=\' \'>08</td><td class=\' \'>09</td><td class=\' \'>10</td><td class=\' \'>11</td><td class=\'tdbdr \'></td><td class=\' \'>0</td><td class=\' \'>1</td><td class=\' \'>2</td><td class=\' \'>3</td><td class=\' \'>4</td><td class=\' \'>5</td><td class=\'tdbdr \'></td><td class=\'thide \'>0</td><td class=\'thide \'>1</td><td class=\'thide \'>2</td><td class=\'thide \'>3</td><td class=\'thide \'>4</td><td class=\'thide \'>5</td><td class=\'tdbdr thide\'></td><td class=\' \'>0</td><td class=\' \'>1</td><td class=\' \'>2</td><td class=\' \'>3</td><td class=\' \'>4</td><td class=\' \'>5</td><td class=\'tdbdr \'></td><td class=\'thide \'>0</td><td class=\'thide \'>1</td><td class=\'thide \'>2</td><td class=\'thide \'>3</td><td class=\'thide \'>4</td><td class=\'thide \'>5</td><td class=\'tdbdr thide\'></td><td class=\' \'>0</td><td class=\' \'>1</td><td class=\' \'>2</td><td class=\' \'>3</td><td class=\' \'>4</td><td class=\' \'>5</td><td class=\'thide \'>0</td><td class=\'thide \'>1</td><td class=\'thide \'>2</td><td class=\'thide \'>3</td><td class=\'thide \'>4</td><td class=\'thide \'>5</td></tr></thead><tbody id=\'data-tab\' class=\'zrxfb\'><tr><td class=\'tdbg_1\' >20170718-43</td><td class=\'tdbdr\'></td><td class=\'tdbg_1\' ><strong class=\'num\'>03 09 02 01 07</strong></td><td class=\'tdbdr\'></td><td class=\'tdbg_1\' ><span class=\'ft16\'>22</span></td><td class=\'tdbdr\'></td><td class=\'tdbg_1\' ><span class=\'ft16\'>8</span></td><td class=\'tdbdr\'></td><td class=\'tdbg_8\' hit><span class=\'ball_5\'>01</span></td><td class=\'tdbg_8\' hit><span class=\'ball_5\'>02</span></td><td class=\'tdbg_8\' hit><span class=\'ball_5\'>03</span></td><td class=\'tdbg_8\' >3</td><td class=\'tdbg_8\' >1</td><td class=\'tdbdr\'></td><td class=\'tdbg_8\' >2</td><td class=\'tdbg_8\' hit><span class=\'ball_5\'>07</span></td><td class=\'tdbg_8\' >5</td><td class=\'tdbg_8\' hit><span class=\'ball_5\'>09</span></td><td class=\'tdbg_8\' >1</td><td class=\'tdbg_8\' >1</td><td class=\'tdbdr\'></td><td class=\'tdbg_3\' >507</td><td class=\'tdbg_3\' >4</td><td class=\'tdbg_3\' hit><span class=\'ball_17\'>2</span></td><td class=\'tdbg_3\' >1</td><td class=\'tdbg_3\' >23</td><td class=\'tdbg_3\' >13</td><td class=\'tdbdr\'></td><td class=\'tdbg_3 thide\' >13</td><td class=\'tdbg_3 thide\' >23</td><td class=\'tdbg_3 thide\' >1</td><td class=\'tdbg_3 thide\' hit><span class=\'ball_18\'>3</span></td><td class=\'tdbg_3 thide\' >4</td><td class=\'tdbg_3 thide\' >507</td><td class=\'tdbdr thide\'></td><td class=\'tdbg_3\' >47</td><td class=\'tdbg_3\' >5</td><td class=\'tdbg_3\' >4</td><td class=\'tdbg_3\' >1</td><td class=\'tdbg_3\' hit><span class=\'ball_1\'>4</span></td><td class=\'tdbg_3\' >41</td><td class=\'tdbdr\'></td><td class=\'tdbg_3 thide\' >41</td><td class=\'tdbg_3 thide\' hit><span class=\'ball_19\'>1</span></td><td class=\'tdbg_3 thide\' >1</td><td class=\'tdbg_3 thide\' >4</td><td class=\'tdbg_3 thide\' >5</td><td class=\'tdbg_3 thide\' >47</td><td class=\'tdbdr thide\'></td><td class=\'tdbg_3\' >758</td><td class=\'tdbg_3\' >6</td><td class=\'tdbg_3\' >5</td><td class=\'tdbg_3\' >4</td><td class=\'tdbg_3\' hit><span class=\'ball_2\'>4</span></td><td class=\'tdbg_3\' >58</td><td class=\'tdbg_3 thide\' >58</td><td class=\'tdbg_3 thide\' hit><span class=\'ball_8\'>1</span></td><td class=\'tdbg_3 thide\' >4</td><td class=\'tdbg_3 thide\' >5</td><td class=\'tdbg_3 thide\' >6</td><td class=\'tdbg_3 thide\' >758</td></tr></tbody>';
    }
}

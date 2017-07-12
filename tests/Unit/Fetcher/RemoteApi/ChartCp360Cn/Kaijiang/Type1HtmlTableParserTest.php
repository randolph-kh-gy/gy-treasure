<?php

namespace Tests\Unit\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang;

use GyTreasure\Fetcher\RemoteApi\ChartCp360Cn\Kaijiang\Type1HtmlTableParser;
use PHPUnit\Framework\TestCase;

class Type1HtmlTableParserTest extends TestCase
{
    public function testParse()
    {
        $parser = new Type1HtmlTableParser();
        $array  = $parser->parse($this->_html());

        $this->assertEquals(30, count($array));

        $first = $array[0];
        $this->assertEquals('2017186', $first['issue']);
        $this->assertEquals(['0', '3', '3'], $first['winningNumbers']);

        $last = $array[29];
        $this->assertEquals('2017157', $last['issue']);
        $this->assertEquals(['1', '7', '3'], $last['winningNumbers']);
    }

    private function _html()
    {
        return '<!DOCTYPE html>
<!--[if lte IE 6]><html id="ie6"><![endif]-->
<!--[if IE 7]><html id="ie7"><![endif]-->
<!--[if IE 8]><html id="ie8"><![endif]-->
<!--[if IE 9]><html id="ie9"><![endif]-->
<!--[if !(IE)]><!--><html  id="notie"><!--<![endif]-->
    <head>
        <meta charset="GBK" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="renderer" content="webkit" />
		<meta name="author" content="360彩票(cp.360.cn)" />
        <meta name="copyright" content="Copyright @cp.360.cn 版权所有" />
        <meta name="Keywords" content="360彩票,彩票360,11选5走势图,双色球走势图,大乐透走势图,广东11选5走势图,快3走势图,快乐扑克走势图,黑龙江11选5走势图,15选5走势图,福彩3d走势图,3d走势图,新时时彩走势图,时时彩走势图,老时时彩走势图,七乐彩走势图,七星彩走势图,排列三走势图,排列五走势图" />
        <meta name="Description" content="360彩票--国内最安全的网上购买彩票平台(http://cp.360.cn)。提供双色球，超级大乐透，福彩3D，山东十一运夺金，足彩，竞彩，北单等十多种彩票及开奖号码，走势图等各种数据。" />
        <title>福彩3D历史开奖_360彩票_安全购彩</title>
        <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico"/>
        <link rel="stylesheet" href="http://s0.cp.360.cn/chart/static/v2/css/all.css?v1.0.10.css" />
<link rel="stylesheet" href="http://s0.cp.360.cn/chart/static/v2/css/slowhis.css?v1.0.10.css" />
                <script type="text/javascript">
           // document.domain = "360.cn";
            window.systemTime = \'1499872236\';
                    </script>
        <!--[if IE 6]>
        <script>document.execCommand(\'BackgroundImageCache\', false, true); </script>
        <![endif]-->
            </head>

<body>
    <div id="hd" class="zst-top">
         <div class="mod-topbar clearfix">
            <h1 class="logo"><a href="http://cp.360.cn" target="_blank">360彩票</a></h1>
            <div class="nav-main">
                <ul>
                    <li><a href="http://cp.360.cn" target="_blank"><span>首页</span></a></li> 
                    <li class="active"><a target="_blank" href="http://cp.360.cn/lotteryhall/new?src=nav_new"><span>购彩大厅</span></a></li>
                    <li><a target="_blank" href="http://cp.360.cn/coophall/?src=nav_new"><span>合买</span></a></li>
                    <li><a target="_blank" href="http://cp.360.cn/autobuy/?src=nav_new"><span>跟单</span></a></li>
                    <li><a target="_blank" href="http://cp.360.cn/kj/kaijiang.html?src=nav_new"><span>开奖</span></a></li>
                </ul>
            </div>
            <div class="nav-quirk">
                <a href="http://cp.360.cn/charthome" target="_blank">走势图</a><span>|</span><a href="http://cp.360.cn/exphall" target="_blank">过关</a><span>|</span><a href="http://odds.cp.360.cn/livex/jczq" target="_blank">比分</a><span>|</span><a href="http://cp.360.cn/jifen/" target="_blank">积分</a><span>|</span><a href="http://cp.360.cn/hongbao/" target="_blank">红包</a><span>|</span><a target="_blank" href="http://bbs.360safe.com/forum.php?gid=239">论坛</a><span>|</span><a target="_blank" href="http://cp.360.cn/help/">帮助</a>
            </div>
            <div class="nav-login">
             				<div id="already_login" style="display:none">
					<div class="logined passport_logined_box">
						<a href="http://cp.360.cn/pfbet/" target="_blank"><i class="ico ico-user"></i><span class="passport_username userName" email=""></span></a>
                        <a href="http://cp.360.cn/pfmessage/" target="_blank" style="font-size: 12px;display: none;"><i class="ico ico-msg"></i> (<em class="passport_msg_count "></em>)</a>
                        <span class="divider">|</span><div class="dropdown" id="mycp">
						<a class="dropdown-toggle" href="http://cp.360.cn/pfbet/"><span>我的彩票</span><span class="caret"></span></a>
						</div><span class="divider">|</span><a href="http://cp.360.cn/user/logout/">退出</a>
					</div>
					<div class="dropdown dropdown-active" id="mycpactive" style="display: none;">
						<a class="dropdown-toggle mycp2" href="http://cp.360.cn/pfbet/" target="_blank"><span>我的彩票</span><span class="caret caret-open"></span></a>
						<div class="dropdown-menu">
							<div class="mod-my-cp-dlg">
								<div class="base-info">
									<p>资金概况：<img id="money_loading" src="http://p4.qhimg.com/t01d75074755ea9e041.gif" style="vertical-align:middle;" /></p>
									<ul class="list">
										<li><span class="k">账户总额：</span><span class="v"><b class="em money_all">0.00</b> 元</span> <a href="http://cp.360.cn/pfchongzhi/" target="_blank" class="btn-middle btn-middle-primary">充值</a></li>
										<li><span class="k">可用现金：</span><span class="k"><b class="money_xianjin">0</b> 元</span></li>
                                        <li><span class="k">通用红包：</span><span class="k"><b class="money_hongbao">0</b> 元</span></li>
                                        <li><span class="k">活动红包：</span><span class="k"><a href="http://cp.360.cn/pfhongbao/?idx=1"><b class="money_active_hongbao gray999">0</b> 个</a></span></li>
										<li><span class="k">当前积分：</span><span class="k"><b class="money_jifen">0</b> 个</span></li>
										<li><span class="k">提款申请：</span><span class="v"><b class="k money_tikuan">暂无</b><span class="divider">|</span><a class="lnk" href="http://cp.360.cn/pftikuan/" target="_blank">提款</a></span></li>
									</ul>
								</div>
								<div class="nav">
									<h3>快速通道</h3>
									<ul class="nav-1">
										<li><a href="http://cp.360.cn/pfbet/" target="_blank">购彩记录</a></li>
										<li><a href="http://cp.360.cn/pftrace/" target="_blank">追号记录</a></li>
										<li><a href="http://cp.360.cn/projlist/autobuylist/" target="_blank">跟单记录</a></li>
									</ul>
									<ul class="nav-2">
										<li><a class="lnk" href="http://cp.360.cn/pfxiaofei/" target="_blank"><i class="ico ico-account"></i>账户明细</a></li>
										<li><a class="lnk" href="http://cp.360.cn/pfzhiliao/mpp/" target="_blank"><i class="ico ico-pwd"></i>修改密码</a></li>
										<li><a class="lnk" href="http://cp.360.cn/pfzhiliao/" target="_blank"><i class="ico ico-user2"></i>个人资料</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="need_login" style="display:block;">
					<div class="login passport_login_box" style="display: block">
						<a href="#" class="passport_login">我的彩票</a><span class="divider">|</span><a href="#" class="passport_login" onclick="Q.lightBox.login(\'\');">登录</a><span class="divider">|</span><a href="#" class="passport_reg"  onclick="Q.lightBox.reg(\'\');">注册</a>
					</div>
				</div>
            </div>
        </div>        
 <div class="mod-caizhong clearfix">
            <dl class="group group-1">
                <dt><span class="ico-cz ico-cz-10" title="数字彩"></span></dt>
                <dd style="width: 190px;">
                    <a href="http://cp.360.cn/ssq/">双色球</a>
                    <a href="http://cp.360.cn/slt/">大乐透</a>
                    <a href="http://cp.360.cn/sd/">福彩3D</a>
                    <a href="http://cp.360.cn/p3/">排列三</a>
                    <a href="http://cp.360.cn/qlc/">七乐彩</a>
                    <a href="http://cp.360.cn/xw/">15选5</a>
                    <a href="http://cp.360.cn/qxc/" style="width:42px;">七星彩</a>
                    <a href="http://cp.360.cn/p5/">排列五</a>
                </dd>
            </dl>
            <dl class="group group-2" style="margin-left: 0;">
                <dt><span class="ico-cz ico-cz-11" title="高频彩"></span></dt>
                <dd style="width:446px;">    
                    <a href="http://cp.360.cn/yun11/" style="margin-right: 25px;">11选5</a>
                    <a href="http://cp.360.cn/gd11/">粤11选5&nbsp;&nbsp;&nbsp;</a>
					<a href="http://cp.360.cn/ln11/" title="辽宁11选5">辽宁11选5</a>
					<a href="http://cp.360.cn/pk3/" title="快乐扑克" style="margin-right: 17px;">快乐扑克</a>
                    <a href="http://cp.360.cn/ssccq/">老时时彩</a>
          			<a href="http://cp.360.cn/k3gx/" title="好运快三">好运快3</a>
                    <a href="http://cp.360.cn/k3hb/" title="湖北快三">湖北快3</a>
          			<br />
                    <a href="http://cp.360.cn/dlcjx/">新11选5</a>
                    <a href="http://cp.360.cn/sh11" title="上海11选5" style="margin-right: 13px;">上海11选5</a>
                    <a href="http://cp.360.cn/hlj11/">幸运11选5</a>
                    <a href="http://cp.360.cn/xj11/">快乐11选5</a>
                    <a href="http://cp.360.cn/k3js/">老快3</a>
                    <a href="http://cp.360.cn/k3jl/">新快3</a>
                    <a href="http://cp.360.cn/k3nm/" title="快3">快3</a>
                    <a href="http://cp.360.cn/kl8/">快乐8</a>
					<!-- <span class="more-show" onmouseover="javascript:$(this).addClass(\'mhover\');" onmouseout="javascript:$(this).removeClass(\'mhover\')">
                    	<span class="item-more-hd">更多 <span class="num">(<span class="d">2</span>)</span> <i class="ico"></i></span>
                    	<ul class="item-more-list">
							<li><a href="http://cp.360.cn/hlj11/">幸运11选5</a></li>
							<li><a href="http://cp.360.cn/k3gx/" title="好运快三">好运快3</a></li>
						</ul>
                    </span> -->
                </dd>
            </dl>
            <dl class="group group-3" style="margin-left: 0;width: ">
                <dt><span class="ico-cz ico-cz-12" title="竞技彩"></span></dt>
              
                <dd style="width: 217px;">
                    <a href="http://cp.360.cn/jczq/">竞彩足球</a>
                    <a href="http://cp.360.cn/dc/">北京单场</a>
                    <a href="http://cp.360.cn/zc/">胜负彩</a>
                    <a href="http://cp.360.cn/dcsf/">胜负过关</a>
                    <a href="http://cp.360.cn/jczqdg/" target="_blank">单关固赔</a>
                    <a href="http://cp.360.cn/jclq/">竞彩篮球</a>
                    <a href="http://cp.360.cn/rj/">任选九</a>
                    <a href="http://cp.360.cn/jq4/">4场</a>
                    <a href="http://cp.360.cn/zc6/">6场</a>
                    <!-- <a href="/gj/">冠亚军</a> -->
                </dd>
              
               <!--dd style="width: 210px;">
                    <a href="http://cp.360.cn/jczq/">竞彩足球</a>
                    <a href="http://cp.360.cn/dc/">北京单场</a>
                    <a href="http://cp.360.cn/zc/">胜负彩</a>
                    <a href="http://cp.360.cn/rj/">任选九</a>
                    <a href="http://cp.360.cn/jclq/">竞彩篮球</a>
                    <a href="http://cp.360.cn/dcsf/">胜负过关</a>
                    <a href="http://cp.360.cn/jq4/">进球彩</a>
                    <a href="http://cp.360.cn/zc6/">半全场</a>
                    <!-- <a href="http://cp.360.cn/gj/">冠亚军</a> -->
                <!--/dd-->
            </dl>
</div>
 
<!--a style="position:absolute; top:36px;left: 592px;height:22px;" href="http://cp.360.cn/k3gx/"><img src="http://p7.qhimg.com/t017b6eec197e532f84.png"></a>
<a style="position:absolute; top:36px;left: 536px;height:22px;" href="http://cp.360.cn/sscjx/"><img src="http://p7.qhimg.com/t017b6eec197e532f84.png"></a-->

</div>
    <!--幸运购对联start[[-->
<!-- 一元幸运购对联 begin -->
<div class="panle-aside-lucky none">
    <div class="panle-aside-box">
        <div class="panle-aside-cont">
            <span class="panle-aside-close">×</span>
            <div class="panle-aside-hd">
                <h2><img src="http://p4.qhimg.com/t01bb6e560b8bb03064.jpg"></h2>
            </div>
            <div class="panle-aside-bd">
                <ul class=\'panle-goods-list\'>
                    <li>
                        <a href="https://1.360.cn/detail?productId=12" target="_blank">
                            <div class="goods-img"><img src="https://p2.ssl.qhimg.com/t01d3fb560566c442c3.png"></div>
                            <h3 class="goods-name">iPhone 6s 16G</h3>
                            <span class="buy-btn">一元秒杀</span>
                            <div class="goods-mask" style="display: none;"><img src="http://p3.qhimg.com/t014908111b044628dd.png"></div>
                        </a>
                    </li>
                    <li>
                        <a href="https://1.360.cn/detail?productId=95" target="_blank">
                            <div class="goods-img"><img src="https://p3.ssl.qhimg.com/t01d5785f831e1c9659.png"></div>
                            <h3 class="goods-name">iPhone SE 64G</h3>
                            <span class="buy-btn">一元秒杀</span>
                            <div class="goods-mask" style="display: none;"><img src="http://p3.qhimg.com/t015caf93599045b96e.png"></div>
                        </a>
                    </li>
                    <li>
                        <a href="https://1.360.cn/detail?productId=13" target="_blank">
                            <div class="goods-img"><img src="http://p6.qhimg.com/t01119da4f224d19162.png"></div>
                            <h3 class="goods-name">iPad mini4 64G</h3>
                            <span class="buy-btn">一元秒杀</span>
                            <div class="goods-mask" style="display: none;"><img src="http://p9.qhimg.com/t0100263ab2a328eaac.png"></div>
                        </a>
                    </li>
                    <li>
                        <a href="https://1.360.cn/detail?productId=15" target="_blank">
                            <div class="goods-img"><img src="http://p1.qhimg.com/t014bfc8b4986d768b5.png"></div>
                            <h3 class="goods-name">Apple Watch Sport</h3>
                            <span class="buy-btn">一元秒杀</span>
                            <div class="goods-mask" style="display: none;"><img src="http://p7.qhimg.com/t01a1ff5d1c4bc6fe84.png"></div>
                        </a>
                    </li>
                    <li>
                        <a href="https://1.360.cn/detail?productId=128" target="_blank">
                            <div class="goods-img"><img src="http://p3.qhimg.com/t011b28d5b5f3632956.png"></div>
                            <h3 class="goods-name">小米空气净化器2</h3>
                            <span class="buy-btn">一元秒杀</span>
                            <div class="goods-mask" style="display: none;"><img src="http://p3.qhimg.com/t01bbb8ac8f098bbe4f.png"></div>
                        </a>
                    </li>
                    <li>
                        <a href="https://1.360.cn/detail?productId=48" target="_blank">
                            <div class="goods-img"><img src="http://p1.qhimg.com/t0110d852d759ec3f62.jpg"></div>
                            <h3 class="goods-name">乐视电视S50 Air 全配版</h3>
                            <span class="buy-btn">一元秒杀</span>
                            <div class="goods-mask" style="display: none;"><img src="http://p8.qhimg.com/t0189eb06fa91019dab.png"></div>
                        </a>
                    </li>
                    <li>
                        <a href="https://1.360.cn/detail?productId=49" target="_blank">
                            <div class="goods-img"><img src="http://p2.qhimg.com/t013c957b1c0d7abee7.png"></div>
                            <h3 class="goods-name">佳能 700D 单反套件</h3>
                            <span class="buy-btn">一元秒杀</span>
                            <div class="goods-mask" style="display: none;"><img src="http://p0.qhimg.com/t01737ecd3cbca89408.png"></div>
                        </a>
                    </li>
                    <li>
                        <a href="https://1.360.cn/detail?productId=50" target="_blank">
                            <div class="goods-img"><img src="http://p3.qhimg.com/t013c1ba0b161bdab48.png"></div>
                            <h3 class="goods-name">华为 Mate8 全网通</h3>
                            <span class="buy-btn">一元秒杀</span>
                            <div class="goods-mask" style="display: none;"><img src="http://p7.qhimg.com/t01dd4d32e06f5f3f07.png"></div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="panle-aside-ft">
                <h3 class="goods-total">8个商品</h3>
                <span class="trigger-bar prev prev-display"></span>
                <span class="trigger-bar next"></span>
            </div>
        </div>
    </div>
</div>
<div class="panle-aside-showbar" >
    <!--<i class="icon-show-left"></i>-->
</div><!--幸运购对联end]]-->    <div class="site">
	<span>
	<iframe id="online800" src="http://cp.360.cn/live800" width="160" height="21" frameborder="no" border="0" marginwidth="0" marginheight="0" allowtransparency="yes" scrolling="no" style="_height:20px; vertical-align:middle;vertical-align:top\0;+vertical-align:bottom;_vertical-align:middle;" ></iframe>
	</span>
	<strong>您当前的位置：</strong><a href="http://cp.360.cn/?os=pc&src=navhr">360彩票首页</a> 
		&gt; <a href="http://cp.360.cn/kj/kaijiang.html" target="_blank">全国开奖</a>
    	
	 &gt;福彩3D</div><!--end site-->
    <div class="wrap" wday="">
        <div class="chart-hd" lot=\'210053\'>
            <div class="logo">
                <img src="http://p6.qhimg.com/t011d9572a0b9c6e351.png">
                福彩3D            </div>
            <div class="lot">
                <span class="lot-btn">切换彩种</span>
                <div class="lot-pop" style="display:none">
                    <dl>
                        <dt><span class="icon-1"></span>福彩：</dt>
                        <dd>
						<ul>
							<li>
								<a href="/zst/ssq" target="_blank">双色球</a>
								<a href="/zst/sd" target="_blank">福彩3D</a>
							</li>
							<li>
								 <a href="/zst/qlc" target="_blank">七乐彩</a>
								<a href="/zst/xw" target="_blank">15选5</a>
							</li>
						</ul>                       
                        </dd>
                    </dl>
                    <dl>
                        <dt><span class="icon-2"></span>体彩：</dt>
                        <dd>
						<ul>
							<li>
								 <a href="/zst/slt" target="_blank">大乐透</a>
								 <a href="/zst/p3" target="_blank">排列三</a>
							</li>
							<li>
								<a href="/zst/qxc" target="_blank">七星彩</a>
								<a href="/zst/p5" target="_blank">排列五</a>
							</li>
						</ul>                       
                        </dd>
                    </dl>
                    <dl>
                        <dt><span class="icon-3"></span>快频：</dt>
                        <dd>
                        <ul>
                        	<li>
								<a href="/zst/syy" target="_blank">11选5</a>
								<a href="/zst/dlc" target="_blank">新11选5</a>
							</li>
							<li>
								<a href="/zst/gd11" target="_blank">粤11选5</a>
								<a href="/zst/hlj11" target="_blank">幸运11选5</a>
							</li>
							<li>
								<!--<a href="/zst/sscjx" target="_blank">新时时彩</a>-->
								<a href="/zst/ssccq" target="_blank">老时时彩</a>
								<a href="/zst/xj11/" target="_blank">快乐11选5</a>
							</li>
							<li>
								<a href="/zst/k3jl" target="_blank">新快3</a>
								<a href="/zst/k3nm" target="_blank">快3</a>
							</li>
							<li>
								<a href="/zst/k3js" target="_blank">老快3</a>
								<a href="/zst/k3gx" target="_blank">好运快3</a>
							</li>
							<li>
								<a href="/zst/kl8" target="_blank">快乐8</a>
								<a href="/zst/sh11" target="_blank">上海11选5</a>
							</li>
							<li>
								<a href="/zst/k3hb" target="_blank">湖北快3</a>
								<a href="/zst/ln11" target="_blank">辽宁11选5</a>
							</li>
							<li>

                                <!--a href="/zst/cq11/" target="_blank">重庆11选5</a-->
                            </li>
                        </ul>
                        </dd>
                    </dl>
                </div><!--end top-pop -->
            </div><!--end topr-->
            <ul class="chart-tag">
                <li><span><a href="/zst/sd">基本走势</a></span></li>
                <li><span><a href=\'/kxt/sd\'>K线图</a></span></li><li><span><a href=\'/zft/sd\'>直方图</a></span></li><li><span><a href=\'/yltj/sd\'>遗漏统计</a></span></li>                <li class="cur"><span><a href="#">历史开奖数据</a></span></li>
            </ul>
        </div>
        
        <div class=\'chart-sc\'>
            <ul> 
                <li><strong>查询：</strong></li>
                <li><a href=\'#\' class=\'btn-sc btn-sc-cur\'>近30期</a></li><li><a href=\'#\' class=\'btn-sc\'>近50期</a></li><li><a href=\'#\' class=\'btn-sc\'>近100期</a></li>
                <li>
                <div class=\'zdy\'>
                    <a href=\'#\' class=\'zdy-btn zdy-btn-cur\'>自定义查询<em></em></a>
                    <div class=\'zdy-pop\' style=\'display:none;\'> 
                        <div class=\'zdy-tag\'>
                            <a href=\'#\' class=\'cur\'>按期数</a>
                            <a href=\'#\'>按期号</a>
                            <a href=\'#\'>按天数</a> 
                            <a class=\'close\'>关闭</a> 
                        </div> 
                        <div class=\'zdy-cnt\'> 
                            <div class=\'byIssueNum\'><p>我要查询最近&nbsp;<input type=\'text\' class=\'ipt-sc issueNum\'>&nbsp;期</p></div>
                            <div class=\'byIssue\' style=\'display: none;\'>
                                <p>第&nbsp;<input type=\'text\' class=\'ipt-sc issueFrom\' title=\'\'>&nbsp;至&nbsp;<input type=\'text\' class=\'ipt-sc issueTo\' title=\'\'>&nbsp;期</p>
                                <p class=\'issueTip\'>注：输入期号格式为 <span class=\'lastIssue\'>2013061</span></p>
                            </div>
                            <div class=\'byDay\' style=\'display:none;\'>
                                <p>从<span class=\'byDate\'><input type=\'text\' class=\'ipt-sc \' id=\'dateFrom\' readonly=\'\'></span>&nbsp;至&nbsp;<span class=\'byDate\'><input type=\'text\' class=\'ipt-sc \' id=\'dateTo\' readonly=\'\'></span></p>
                            </div> 
                            <p><button class=\'btn-star\'>开始查询</button> <button class=\'btn-rst\'>重 置</button></p>
                        </div> 
                    </div> 
                </div> 
                </li>
            </ul>
            <strong style=\'font-size:14px\'> 福彩3D历史开奖号码</strong>
        </div><!--end chart-sc-->
        <div class=\'chart-tab\'  id=\'his-tab\'><table width=\'100%\' style=\'display: none; width: 980px; position: absolute; z-index: 123; top: -226px;\'><thead class=\'kaijiang\'><tr><th rowspan=\'2\' width=\'10%\'>期号&nbsp; <a href=\'#\' class=\'tharr tharr-up\'></a></th><th rowspan=\'2\' width=\'10%\'>开奖日期</th><th rowspan=\'2\' width=\'15%\'>开奖号码</th><th rowspan=\'2\' width=\'5%\'>试机号</th><th rowspan=\'2\' width=\'12%\'>投注金额（元）</th><th colspan=\'2\' width=\'12%\'>直选</th><th colspan=\'2\' width=\'12%\'>组三</th><th colspan=\'2\' width=\'12%\'>组六</th><th rowspan=\'2\' width=\'9%\'>360中奖</th></tr><tr><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th></tr></thead></table><table width=\'100%\' class=\'his-table\'><thead class=\'kaijiang\'><tr><th rowspan=\'2\' width=\'10%\'>期号&nbsp; <a href=\'#\' class=\'tharr tharr-up\'></a></th><th rowspan=\'2\' width=\'10%\'>开奖日期</th><th rowspan=\'2\' width=\'15%\'>开奖号码</th><th rowspan=\'2\' width=\'5%\'>试机号</th><th rowspan=\'2\' width=\'12%\'>投注金额（元）</th><th colspan=\'2\' width=\'12%\'>直选</th><th colspan=\'2\' width=\'12%\'>组三</th><th colspan=\'2\' width=\'12%\'>组六</th><th rowspan=\'2\' width=\'9%\'>360中奖</th></tr><tr><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th><th width=\'6%\'>注数</th><th width=\'7%\'>奖金（元）</th></tr></thead><tbody id=\'data-tab\'><tr week=\'3\'><td>2017186</td><td>2017-07-12(三)</td><td><span class=\'ball_5\'>0</span>&nbsp;<span class=\'ball_5\'>3</span>&nbsp;<span class=\'ball_5\'>3</span>&nbsp;(组三)<td>696</td><td>39,155,126</td><td>10230</td><td>1,040</td><td>14290</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017186\'>查看统计</a></td></tr><tr week=\'2\'><td>2017185</td><td>2017-07-11(二)</td><td><span class=\'ball_5\'>2</span>&nbsp;<span class=\'ball_5\'>2</span>&nbsp;<span class=\'ball_5\'>8</span>&nbsp;(组三)<td>043</td><td>40,075,260</td><td>16104</td><td>1,040</td><td>11744</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017185\'>查看统计</a></td></tr><tr week=\'1\'><td>2017184</td><td>2017-07-10(一)</td><td><span class=\'ball_5\'>8</span>&nbsp;<span class=\'ball_5\'>9</span>&nbsp;<span class=\'ball_5\'>9</span>&nbsp;(组三)<td>568</td><td>40,389,394</td><td>21369</td><td>1,040</td><td>16548</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017184\'>查看统计</a></td></tr><tr week=\'0\'><td>2017183</td><td>2017-07-09(日)</td><td><span class=\'ball_5\'>9</span>&nbsp;<span class=\'ball_5\'>9</span>&nbsp;<span class=\'ball_5\'>4</span>&nbsp;(组三)<td>881</td><td>41,816,460</td><td>7541</td><td>1,040</td><td>10591</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017183\'>查看统计</a></td></tr><tr week=\'6\'><td>2017182</td><td>2017-07-08(六)</td><td><span class=\'ball_5\'>1</span>&nbsp;<span class=\'ball_5\'>4</span>&nbsp;<span class=\'ball_5\'>8</span>&nbsp;(组六)<td>425</td><td>40,332,100</td><td>11251</td><td>1,040</td><td>0</td><td>346</td><td>26835</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017182\'>查看统计</a></td></tr><tr week=\'5\'><td>2017181</td><td>2017-07-07(五)</td><td><span class=\'ball_5\'>5</span>&nbsp;<span class=\'ball_5\'>6</span>&nbsp;<span class=\'ball_5\'>9</span>&nbsp;(组六)<td>330</td><td>42,893,156</td><td>13699</td><td>1,040</td><td>0</td><td>346</td><td>29672</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017181\'>查看统计</a></td></tr><tr week=\'4\'><td>2017180</td><td>2017-07-06(四)</td><td><span class=\'ball_5\'>3</span>&nbsp;<span class=\'ball_5\'>6</span>&nbsp;<span class=\'ball_5\'>4</span>&nbsp;(组六)<td>412</td><td>42,529,264</td><td>11041</td><td>1,040</td><td>0</td><td>346</td><td>30424</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017180\'>查看统计</a></td></tr><tr week=\'3\'><td>2017179</td><td>2017-07-05(三)</td><td><span class=\'ball_5\'>1</span>&nbsp;<span class=\'ball_5\'>5</span>&nbsp;<span class=\'ball_5\'>9</span>&nbsp;(组六)<td>424</td><td>40,487,080</td><td>18570</td><td>1,040</td><td>0</td><td>346</td><td>26499</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017179\'>查看统计</a></td></tr><tr week=\'2\'><td>2017178</td><td>2017-07-04(二)</td><td><span class=\'ball_5\'>7</span>&nbsp;<span class=\'ball_5\'>4</span>&nbsp;<span class=\'ball_5\'>4</span>&nbsp;(组三)<td>981</td><td>40,880,322</td><td>20413</td><td>1,040</td><td>18542</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017178\'>查看统计</a></td></tr><tr week=\'1\'><td>2017177</td><td>2017-07-03(一)</td><td><span class=\'ball_5\'>9</span>&nbsp;<span class=\'ball_5\'>7</span>&nbsp;<span class=\'ball_5\'>5</span>&nbsp;(组六)<td>126</td><td>40,251,648</td><td>12972</td><td>1,040</td><td>0</td><td>346</td><td>36376</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017177\'>查看统计</a></td></tr><tr week=\'0\'><td>2017176</td><td>2017-07-02(日)</td><td><span class=\'ball_5\'>2</span>&nbsp;<span class=\'ball_5\'>7</span>&nbsp;<span class=\'ball_5\'>6</span>&nbsp;(组六)<td>495</td><td>37,497,772</td><td>17242</td><td>1,040</td><td>0</td><td>346</td><td>33729</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017176\'>查看统计</a></td></tr><tr week=\'6\'><td>2017175</td><td>2017-07-01(六)</td><td><span class=\'ball_5\'>0</span>&nbsp;<span class=\'ball_5\'>0</span>&nbsp;<span class=\'ball_5\'>1</span>&nbsp;(组三)<td>797</td><td>40,239,944</td><td>17197</td><td>1,040</td><td>16689</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017175\'>查看统计</a></td></tr><tr week=\'5\'><td>2017174</td><td>2017-06-30(五)</td><td><span class=\'ball_5\'>4</span>&nbsp;<span class=\'ball_5\'>1</span>&nbsp;<span class=\'ball_5\'>4</span>&nbsp;(组三)<td>469</td><td>43,272,894</td><td>15729</td><td>1,040</td><td>18369</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017174\'>查看统计</a></td></tr><tr week=\'4\'><td>2017173</td><td>2017-06-29(四)</td><td><span class=\'ball_5\'>6</span>&nbsp;<span class=\'ball_5\'>9</span>&nbsp;<span class=\'ball_5\'>4</span>&nbsp;(组六)<td>658</td><td>42,055,536</td><td>12879</td><td>1,040</td><td>0</td><td>346</td><td>29936</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017173\'>查看统计</a></td></tr><tr week=\'3\'><td>2017172</td><td>2017-06-28(三)</td><td><span class=\'ball_5\'>5</span>&nbsp;<span class=\'ball_5\'>5</span>&nbsp;<span class=\'ball_5\'>8</span>&nbsp;(组三)<td>090</td><td>40,771,396</td><td>15463</td><td>1,040</td><td>12116</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017172\'>查看统计</a></td></tr><tr week=\'2\'><td>2017171</td><td>2017-06-27(二)</td><td><span class=\'ball_5\'>3</span>&nbsp;<span class=\'ball_5\'>4</span>&nbsp;<span class=\'ball_5\'>6</span>&nbsp;(组六)<td>354</td><td>40,244,766</td><td>16356</td><td>1,040</td><td>0</td><td>346</td><td>41338</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017171\'>查看统计</a></td></tr><tr week=\'1\'><td>2017170</td><td>2017-06-26(一)</td><td><span class=\'ball_5\'>8</span>&nbsp;<span class=\'ball_5\'>8</span>&nbsp;<span class=\'ball_5\'>1</span>&nbsp;(组三)<td>345</td><td>41,884,216</td><td>14911</td><td>1,040</td><td>14873</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017170\'>查看统计</a></td></tr><tr week=\'0\'><td>2017169</td><td>2017-06-25(日)</td><td><span class=\'ball_5\'>8</span>&nbsp;<span class=\'ball_5\'>5</span>&nbsp;<span class=\'ball_5\'>4</span>&nbsp;(组六)<td>884</td><td>40,559,766</td><td>25306</td><td>1,040</td><td>0</td><td>346</td><td>45578</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017169\'>查看统计</a></td></tr><tr week=\'6\'><td>2017168</td><td>2017-06-24(六)</td><td><span class=\'ball_5\'>1</span>&nbsp;<span class=\'ball_5\'>3</span>&nbsp;<span class=\'ball_5\'>6</span>&nbsp;(组六)<td>964</td><td>38,781,356</td><td>14528</td><td>1,040</td><td>0</td><td>346</td><td>29021</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017168\'>查看统计</a></td></tr><tr week=\'5\'><td>2017167</td><td>2017-06-23(五)</td><td><span class=\'ball_5\'>4</span>&nbsp;<span class=\'ball_5\'>7</span>&nbsp;<span class=\'ball_5\'>1</span>&nbsp;(组六)<td>395</td><td>40,413,596</td><td>9395</td><td>1,040</td><td>0</td><td>346</td><td>33830</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017167\'>查看统计</a></td></tr><tr week=\'4\'><td>2017166</td><td>2017-06-22(四)</td><td><span class=\'ball_5\'>4</span>&nbsp;<span class=\'ball_5\'>9</span>&nbsp;<span class=\'ball_5\'>6</span>&nbsp;(组六)<td>078</td><td>37,301,602</td><td>13980</td><td>1,040</td><td>0</td><td>346</td><td>35327</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017166\'>查看统计</a></td></tr><tr week=\'3\'><td>2017165</td><td>2017-06-21(三)</td><td><span class=\'ball_5\'>3</span>&nbsp;<span class=\'ball_5\'>3</span>&nbsp;<span class=\'ball_5\'>3</span>&nbsp;(豹子)<td>011</td><td>39,235,576</td><td>49152</td><td>1,040</td><td>0</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017165\'>查看统计</a></td></tr><tr week=\'2\'><td>2017164</td><td>2017-06-20(二)</td><td><span class=\'ball_5\'>3</span>&nbsp;<span class=\'ball_5\'>1</span>&nbsp;<span class=\'ball_5\'>2</span>&nbsp;(组六)<td>391</td><td>39,537,828</td><td>8713</td><td>1,040</td><td>0</td><td>346</td><td>21820</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017164\'>查看统计</a></td></tr><tr week=\'1\'><td>2017163</td><td>2017-06-19(一)</td><td><span class=\'ball_5\'>0</span>&nbsp;<span class=\'ball_5\'>0</span>&nbsp;<span class=\'ball_5\'>8</span>&nbsp;(组三)<td>335</td><td>41,126,294</td><td>4989</td><td>1,040</td><td>6641</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017163\'>查看统计</a></td></tr><tr week=\'0\'><td>2017162</td><td>2017-06-18(日)</td><td><span class=\'ball_5\'>3</span>&nbsp;<span class=\'ball_5\'>9</span>&nbsp;<span class=\'ball_5\'>8</span>&nbsp;(组六)<td>970</td><td>39,096,630</td><td>12353</td><td>1,040</td><td>0</td><td>346</td><td>35196</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017162\'>查看统计</a></td></tr><tr week=\'6\'><td>2017161</td><td>2017-06-17(六)</td><td><span class=\'ball_5\'>7</span>&nbsp;<span class=\'ball_5\'>9</span>&nbsp;<span class=\'ball_5\'>7</span>&nbsp;(组三)<td>017</td><td>39,118,936</td><td>9694</td><td>1,040</td><td>12880</td><td>346</td><td>0</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017161\'>查看统计</a></td></tr><tr week=\'5\'><td>2017160</td><td>2017-06-16(五)</td><td><span class=\'ball_5\'>2</span>&nbsp;<span class=\'ball_5\'>1</span>&nbsp;<span class=\'ball_5\'>0</span>&nbsp;(组六)<td>464</td><td>43,493,006</td><td>8793</td><td>1,040</td><td>0</td><td>346</td><td>15452</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017160\'>查看统计</a></td></tr><tr week=\'4\'><td>2017159</td><td>2017-06-15(四)</td><td><span class=\'ball_5\'>8</span>&nbsp;<span class=\'ball_5\'>7</span>&nbsp;<span class=\'ball_5\'>2</span>&nbsp;(组六)<td>634</td><td>44,772,604</td><td>10782</td><td>1,040</td><td>0</td><td>346</td><td>22938</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017159\'>查看统计</a></td></tr><tr week=\'3\'><td>2017158</td><td>2017-06-14(三)</td><td><span class=\'ball_5\'>2</span>&nbsp;<span class=\'ball_5\'>8</span>&nbsp;<span class=\'ball_5\'>5</span>&nbsp;(组六)<td>110</td><td>45,034,730</td><td>19982</td><td>1,040</td><td>0</td><td>346</td><td>44615</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017158\'>查看统计</a></td></tr><tr week=\'2\'><td>2017157</td><td>2017-06-13(二)</td><td><span class=\'ball_5\'>1</span>&nbsp;<span class=\'ball_5\'>7</span>&nbsp;<span class=\'ball_5\'>3</span>&nbsp;(组六)<td>249</td><td>44,125,152</td><td>22456</td><td>1,040</td><td>0</td><td>346</td><td>60181</td><td>173</td><td><a target=\'_blank\' href=\'http://cp.360.cn/experience/sd?Issue=2017157\'>查看统计</a></td></tr></tbody></table></div>    </div><!--end wrap-->	
<div class="quick">
	<h2>
	<span class="quick-cls"></span>
    快速购买 福彩3D	</h2>
	<div class="quick-pop">		
		<iframe height="560" frameborder="0" width="100%" scrolling="auto" src="" name="kstz"></iframe>		
	</div><!--end quick-pop-->
</div><!--end quick-->
    <div class="footer">
	<p>
	<a href="http://bbs.360.cn/5473003/250358455.html?page=1&type=1#layer_1" target="_blank">关于360彩票</a>
	<a href="http://www.360.cn/about/zhaopin.html" target="_blank">招聘信息</a>
	<a href="http://bbs.360.cn/5473003/250360602.html?page=1&type=1&mpost=1#layer_1" target="_blank">联系我们</a>
	<a href="http://bbs.360.cn/5473003.html?fst=3" target="_blank">投诉建议</a>
	<a href="http://www.360.cn/custom/bdhezuo.html" target="_blank">合作伙伴</a>
	<a href="http://cp.360.cn/activity/feedback/" target="_blank">意见反馈</a>
	</p>
	<span class="other">
	<a class="o1" href="http://www.bj.cyberpolice.cn/index.jsp" target="_blank"></a>
	<!-- <a class="o2" href="http://www.360.cn/award3.html" target="_blank"></a> -->
	<a class="o3" href="http://www.360.cn/award1.html" target="_blank"></a>
	<a class="o4" href="http://www.bjjubao.org/" target="_blank"></a>
	<a class="o5" href="https://www.privacyassociation.org/" target="_blank"></a>
	</span>
	<p>
	<em>Copyright&copy;2005-2017 360.cn版权所有</em>
	<a href="http://www.miibeian.gov.cn/state/outPortal/loginPortal.action" target="_blank">京ICP证080047号[原京ICP备06060858号]</a>
	<em>京公网安备110000000006号</em>
	<a href="http://www.360.cn/gongshangyingyezhizhao.html" target="_blank">工商营业执照</a>
	</p>
	<p>
	<!--em>客服电话：010-59059560</em-->
	<em>客服邮箱：caipiao@360.cn</em>
	<em>投诉建议邮箱：caipiao@360.cn</em>
	</p>
	<p class="red">360彩票郑重提示：彩票有风险，投注需谨慎！禁止向未满18周岁的青少年出售彩票！</p>
</div><!--end  footer-->
    <script src="http://s5.cp.360.cn/chart/jquery/jquery-1.7.2.min.js"></script>
<script src="http://s5.cp.360.cn/chart/static/v2/js/lib/hislibs.js?v1.0.18.js"></script>
<script src="http://s5.cp.360.cn/chart/static/v2/js/hisJS/slowhis.js?v1.0.18.js"></script>
    <script src="https://jspassport.ssl.qhimg.com/5.0.3/full.js"></script>
<link rel="stylesheet" href="/static/v2/css/quc.css">
<script src="/static/v2/js/lib/passport.js","></script>
<script src="http://s5.qhimg.com/monitor/;monitor/b862fb33.js"></script>
<script>monitor.setProject(\'360_cp_chart\').getTrack().getClickAndKeydown();</script></body>
</html>';
    }
}
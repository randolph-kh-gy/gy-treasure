<?php

namespace Tests\Unit\Fetcher\RemoteApi\Caipiao163Com\Award;

use GyTreasure\Fetcher\RemoteApi\Caipiao163Com\Award\HallHtmlTableParser;
use PHPUnit\Framework\TestCase;

class HallHtmlTableParserTest extends TestCase
{
    public function testParse()
    {
        $parser = new HallHtmlTableParser();
        $returnArray = $parser->parse($this->_html());

        $this->assertEquals('17186', $returnArray['pl3'][0]['issue']);
        $this->assertEquals(['9', '6', '7'], $returnArray['pl3'][0]['winningNumbers']);

        $this->assertEquals('170713064', $returnArray['ssc'][0]['issue']);
        $this->assertEquals(['0', '4', '0', '1', '4'], $returnArray['ssc'][0]['winningNumbers']);
    }

    private function _html()
    {
        return '<!DOCTYPE HTML>
<html>
<head>
<link rel="shortcut icon" href="/favicon.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="application-name" content="caipiao.163.com"/>
<meta name="msapplication-TileColor" content="#b82337"/>
<meta name="msapplication-TileImage" content="e0226958-5751-416d-bee6-4f2a40735ac2.png"/>
<meta name="renderer" content="webkit">
<meta name="keywords" content="彩票开奖,彩票开奖结果,彩票开奖查询"/>
<meta name="description" content="网易彩票开奖中心：公布福彩、体彩、足彩和高频彩票的开奖结果.包括双色球、超级大乐透、快乐8、3D、排列三、排列五、七星彩、七乐彩等彩票,网上买彩票开奖结果查询到网易彩票."/>
<meta http-equiv="Cache-Control" content="no-transform"/>
<title>彩票开奖,彩票开奖结果,彩票开奖查询_网易彩票</title>
		<link rel="alternate" media="only screen and(max-width:640px)" href="http://caipiao.163.com/t/award/">
		<meta name="mobile-agent" content="format=xhtml;url=http://caipiao.163.com/m/search.jsp">
		<meta name="mobile-agent" content="format=wml;url=http://caipiao.163.com/m/search.jsp">
<link rel="canonical" href="http://caipiao.163.com/award/"/>
<link rel="stylesheet" href="http://pimg1.126.net/caipiao/css2/base.css?2017070419421499168574"/><link rel="stylesheet" href="http://pimg1.126.net/caipiao/css2/core.css?2017070419421499168574"/><link rel="stylesheet" href="http://pimg1.126.net/caipiao/css2/award/award.css?2017070419421499168574"/><script src="http://pimg1.126.net/caipiao/js2/jquery-1.4.2.js?20150408"></script><script src="http://caipiao.163.com/globalConfig.html?1499935483632"></script><script src="http://pimg1.126.net/caipiao/js2/easyCore.js?2017070419421499168574"></script>
</head>
<body class="">
<noscript><div id="noScript">
<div><h2>请开启浏览器的Javascript功能</h2><p>亲，没它我们玩不转啊！求您了，开启Javascript吧！<br/>不知道怎么开启Javascript？那就请<a href="http://www.baidu.com/s?wd=%E5%A6%82%E4%BD%95%E6%89%93%E5%BC%80Javascript%E5%8A%9F%E8%83%BD" rel="nofollow" target="_blank">猛击这里</a>！</p></div>
</div></noscript>
<nav id="topNav">
	<div id="topNavWrap">
		<div id="topNavLeft"><script>Core.navInit("http://pimg1.126.net/caipiao","","2017070419421499168574","1499935483632")</script></div>
		<ul id="topNavRight">
			<li><a href="https://epay.163.com/" id="myEpay" notice="false" target="_blank">我的网易支付</a>&nbsp;&nbsp;<span id="topEpayInfo"></span>|</li>
			<li>
				<div id=\'myCoupon\'>
					<div class="mcDropMenuBox fl">
						<a target="_top" user="y" class="topNavHolder" href="http://caipiao.163.com/my/coupon.html#from=top" rel="nofollow"><em class="text_icon"></em>红包<i></i></a>
						<div class="mcDropMenu couponContent"></div>
					</div>
					&nbsp;&nbsp;<a target="_blank" user="y" href="http://caipiao.163.com/sale/coupon_saleCouponIn.html#from=top" id="buyCoupon">购买</a>&nbsp;&nbsp;|
				</div>
			</li>
			<li><div class="mcDropMenuBox myorder">
				<a target="_top" user="y" class="topNavHolder" href="http://caipiao.163.com/my/order.html" rel="nofollow"><em class="text_icon"></em>我的订单<i></i></a><b class="holderLine">|</b>
				<div class="mcDropMenu">
					<a target="_top" user="y" href="http://caipiao.163.com/my/order_followbuy.html#from=top" rel="nofollow">我的追号</a>
					<a target="_top" user="y" href="http://caipiao.163.com/my/order_autofollow.html#from=top" rel="nofollow">定制跟单</a>
				</div>
			</div></li>
			<li><div class="mcDropMenuBox">
				<a target="_top" user="y" class="topNavHolder" href="http://caipiao.163.com/order/mylottery_info.html#from=top" rel="nofollow">我的彩票<i></i></a><b class="holderLine">|</b>
				<div class="mcDropMenu">
					<a target="_top" user="y" href="http://caipiao.163.com/my/coupon.html#from=top" rel="nofollow">我的红包</a>
					<a target="_top" user="y" href="http://caipiao.163.com/my/credit.html#act=jifen&from=top" rel="nofollow">我的积分</a>
					<a target="_top" user="y" href="http://caipiao.163.com/order/myactivity_drawaward.html#from=top" rel="nofollow">我的活动</a>
					<a target="_top" user="y" href="http://caipiao.163.com/my/message.html#from=top" rel="nofollow">消息中心</a>
					<a target="_blank" user="y" href="http://caipiao.163.com/homepage/homepage_index.html#from=top" rel="nofollow">个人主页</a>
				</div>
			</div></li>
            <li><a target="_blank" href="http://bbs.caipiao.163.com/" rel="nofollow">论坛</a>&nbsp;&nbsp;|</li>
			<li><div class="mcDropMenuBox">
				<a target="_blank" class="topNavHolder" href="http://caipiao.163.com/help/" rel="nofollow">帮助<i></i></a>
				<div class="mcDropMenu">
					<a target="_blank" href="http://caipiao.163.com/help/13/0222/19/8OBGCEEN00754KE8.html" rel="nofollow">如何充值</a>
					<a target="_blank" href="http://caipiao.163.com/help/special/award/" rel="nofollow">如何领奖</a>
					<a target="_blank" href="http://caipiao.163.com/help/13/0222/19/8OBGFK7200754KE9.html" rel="nofollow">如何提现</a>
					<a target="_blank" href="http://caipiao.163.com/help/" rel="nofollow">更多帮助</a>	
                    <a target="_blank" href="http://caipiao.163.com/kf.html" rel="nofollow">意见反馈</a>				
				</div>
			</div></li>
            
		</ul>
	</div>
</nav>
<header id="docHead" rel=""><div id="docHeadWrap">
	<a href="http://caipiao.163.com/" class="logoLnk" title="网易彩票" hidefocus="true"><h1>网易彩票<img src="http://pimg1.126.net/caipiao/img/logos/caipiao.png?2017070419421499168574" alt="网易彩票" title="网易彩票网"/></h1></a>
	<a href="http://caipiao.163.com/order/jczq/#from=dt " rel="nofollow" class="guideLnk" target="_blank" hidefocus="true"><span>网易彩票</span></a>
	<p>
		<span class="serviceTel">
			<span class="serviceTel_tel">
			<span>客服热线</span><br/>
			<strong>0571-26201163</strong>
			</span>
            <a class="onlineService " href="http://caipiao.163.com/kf.html" target="_blank">在线客服</a>
		</span>
	</p>
</div></header>
<nav id="topTabBox">
	<div id="topTab">
		<ul id="funcTab"><li id="lotteryListEntry"><a class="topNavHolder" hidefocus="true" rel="nofollow">选择彩种<i></i></a>
<div id="lotteryList">
	<div class="lotteryListWrap">
		<ul>
		<li class="zyGame"><a href="http://caipiao.163.com/order/ssq/#from=leftnav" gid="ssq"><em class="cz_logo35 logo35_ssq"></em><strong>双色球</strong></a></li>
		<li class="zyGame"><a href="http://caipiao.163.com/order/dlt/#from=leftnav" gid="dlt"><em class="cz_logo35 logo35_dlt"></em><strong>大乐透</strong></a></li>
		<li class="zyGame"><a href="http://caipiao.163.com/order/jczq/#from=leftnav" gid="jczq"><em class="cz_logo35 logo35_jczq"></em><strong>竞彩足球</strong></a></li>
        <li class="zyGame"><a href="http://caipiao.163.com/order/jclq/mixp.html#from=leftnav" gid="jclq_mix_p"><em class="cz_logo35 logo35_jclq"></em><strong>竞彩篮球</strong></a></li>
		<li class="zyGame"><a href="http://caipiao.163.com/order/11xuan5/#from=leftnav" gid="d11"><em class="cz_logo35 logo35_d11"></em><strong>11选5</strong></a></li>
		<li class="zyGame"><a href="http://caipiao.163.com/order/gxkuai3/#from=leftnav" gid="gxkuai3"><em class="cz_logo35 logo35_gxkuai3"></em><strong>新快3</strong></a></li>
		<li class="otherGames clearfix">
			<h3>高频</h3>
			<div>
				<em class="left"><a href="http://caipiao.163.com/order/gd11xuan5/#from=leftnav" title="猜对1个号就中奖，每天84期" gid="gdd11">粤11选5</a></em>
				<em><a href="http://caipiao.163.com/order/jx11xuan5/#from=leftnav" title="每天78期，任猜1-8个号都中奖" gid="jxd11">老11选5</a></em>
				<em class="left"><a href="http://caipiao.163.com/order/hlj11xuan5/#from=leftnav" title="猜中一个号就中奖，返奖率59%" gid="hljd11">好运11选5</a></em>
                <em><a href="http://caipiao.163.com/order/zj11xuan5/#from=leftnav" title="每天80期，任猜1-8个号都中奖" gid="zjd11">易乐11选5</a></em>
                <em class="left"><a href="http://caipiao.163.com/order/cq11xuan5/#from=leftnav" title="每天85期，猜中一个号就中奖，返奖率59%" gid="cqd11">重庆11选5</a></em>
				<em class="left"><a href="http://caipiao.163.com/order/ln11xuan5/#from=leftnav" title="每天83期，猜中一个号就中奖，返奖率59%" gid="lnd11">辽宁11选5</a></em>
				<em><a href="http://caipiao.163.com/order/kl8/#from=leftnav" title="5分钟一期，最高奖500万" gid="kl8">快乐8</a></em>
				<em class="left"><a href="http://caipiao.163.com/order/kuai3/#from=leftnav" title="10分钟一期，快乐猜大小" gid="kuai3">快3</a></em>
				<em><a href="http://caipiao.163.com/order/jskuai3/#from=leftnav" title="最容易中奖，全天82期" gid="oldkuai3">江苏快3</a></em>
				<em class="left"><a href="http://caipiao.163.com/order/jxssc/#from=leftnav" title="10分钟一期，最高奖11.6万" gid="jxssc">新时时彩</a></em>
				<em><a href="http://caipiao.163.com/order/cqssc/#from=leftnav" title="独有夜间版，01：55截止" gid="ssc">重庆时时彩</a></em>
				<em class="left"><a href="http://caipiao.163.com/order/gdkuai2/#from=leftnav" title="猜中一个号就中奖，5分钟一期" gid="kuai2">快2</a></em>
				<em><a href="http://caipiao.163.com/order/gdklsf/#from=leftnav" gid="kl10">粤快乐十分</a></em>
                <em><a href="http://caipiao.163.com/order/zjkuaile12/#from=leftnav" gid="klc">快乐彩</a></em>
			</div>
		</li>
		<li class="otherGames clearfix">
			<h3>竞技</h3>
			<div>
				<em class="left"><a href="http://caipiao.163.com/order/dc/#from=leftnav" title="猜一场即中奖" gid="football_dcspf">足球单场</a></em>
                <em><a href="http://caipiao.163.com/order/sfgg/#from=leftnav" gid="football_dcsfgg">胜负过关</a></em>
				<em class="left"><a href="http://caipiao.163.com/order/f4cjq/#from=leftnav" gid="football_f4cjq">四场进球</a></em>
				<em><a href="http://caipiao.163.com/order/sfc/#from=leftnav" title="猜中14场大奖500万" gid="football_sfc">胜负彩</a></em>
				<em class="left"><a href="http://caipiao.163.com/order/bqc/#from=leftnav" gid="football_bqc">六场半全场</a></em>
				<em ><a href="http://caipiao.163.com/order/rx9/#from=leftnav" title="任选九场比赛" gid="football_9">任选九场</a></em>
			</div>
		</li>
		<li class="otherGames end clearfix">
			<h3>数字</h3>
			<div>
				<em class="left"><a href="http://caipiao.163.com/order/3d/#from=leftnav" title="2元赢取1000元，天天开奖" gid="x3d">福彩3D</a></em>
				<em><a href="http://caipiao.163.com/order/qlc/#from=leftnav" title="大奖500万 每周一、三、五开奖" gid="qlc">七乐彩</a></em>
				<em class="left"><a href="http://caipiao.163.com/order/pl3/#from=leftnav" title="2元赢取1000元，天天开奖" gid="pl3">排列3</a></em>
				<em><a href="http://caipiao.163.com/order/qxc/#from=leftnav" title="大奖500万 每周二、五、日开奖" gid="qxc">七星彩</a></em>
				<em class="left"><a href="http://caipiao.163.com/order/pl5/#from=leftnav" title="2元赢取10万元，天天开奖" gid="pl5">排列5</a></em>
			</div>
		</li>
	</ul>
	</div>
</div>
</li><li pid="home"><a href="http://caipiao.163.com/">首页</a>|</li><li pid="hall"><a href="http://caipiao.163.com/order/" title="彩票购彩大厅">购彩大厅</a>|</li>		<li pid="groupbuy" class="wordsNum2"><a href="http://caipiao.163.com/groupbuy/" title="彩票合买大厅" rel="nofollow">合买<i></i></a>|
            <div class="mcDropMenu">
                <a href="http://caipiao.163.com/groupbuy/" rel="nofollow">合买大厅</a>
                <a href="http://caipiao.163.com/followhall/" rel="nofollow">定制跟单</a>
            </div>
</li>		<li pid="award" class="wordsNum4 active"><a href="http://caipiao.163.com/award/" title="中国彩票开奖">彩票开奖<i></i></a>|
            <div class="mcDropMenu">
                <a href="http://caipiao.163.com/award/">开奖公告</a>
                <a href="http://caipiao.163.com/hit/hit_ssq.html?index=1" rel="nofollow">中奖排行</a>
            </div>
</li><li pid="trend"><a href="http://trend.caipiao.163.com/" title="福彩体彩走势图">走势图</a>|</li>        <li pid="saishi" class="wordsNum4 tl"><a href="http://live.caipiao.163.com/" title="赛事数据">赛事数据<i></i></a>|
            <div class="mcDropMenu">
            	<a href="http://live.caipiao.163.com/">比分直播</a>
                <a href="http://saishi.caipiao.163.com">足球资料库</a>
                <a href="http://odds.caipiao.163.com/">赔率中心</a>
				<a href="http://basketball.caipiao.163.com/">篮球资料库</a>
            </div>
</li><li pid="cpInfo"><a href="http://cai.163.com/" title="彩票资讯">彩票资讯</a>|</li>		<li pid="coupon" class="wordsNum2"><a href="http://caipiao.163.com/sale/coupon_saleCouponIn.html" title="优惠">优惠<i></i></a>|
            <div class="mcDropMenu">
                <a href="http://caipiao.163.com/sale/coupon_saleCouponIn.html">彩票红包</a>
                <a href="http://caipiao.163.com/jifen/">积分乐园</a>
            </div>
</li><li pid="mobile"><a href="http://caipiao.163.com/outside/getclient_cp.html" title="手机购买彩票">手机购彩</a></li>		</ul>
	</div>
</nav>
<article class="docBody clearfix">
	<nav class="breadCrumb"> 您的位置：<a target="_blank" href="http://caipiao.163.com">网易彩票</a>&nbsp;&gt;&nbsp;
		<h1>彩票开奖</h1>
	</nav>
	
	<section class="main">
		<h2 class="title">
			<strong>彩票最新开奖公告</strong>
			<span><a href="http://caipiao.163.com/help/13/0221/16/8O8JEK1S00754IHP.html#from=kjdt" target="_blank">如何购彩？</a>|<a href="http://caipiao.163.com/help/special/award/#from=kjdt" target="_blank">如何领奖？</a></span>
		</h2>
		<div class="todayAward clearfix">
			<div class="detail">2017-07-13 （周四）<strong>今日开奖：</strong><a href="/order/ssq/#from=kjdt" target="_blank">双色球</a><a href="/order/3d/#from=kjdt" target="_blank">3D</a><a href="/order/pl5/#from=kjdt" target="_blank">排列5</a><a href="/order/pl3/#from=kjdt" target="_blank">排列3</a></div>
			<div class="links">
				<a class="subscription" href="http://caipiao.163.com/my/subscription.html#from=kjdt" target="_blank"><i></i>邮件订阅</a>
				<a class="getclient" href="http://caipiao.163.com/outside/getclient_cp.html#from=kjdt"><i></i>客户端看开奖</a>
			</div>
		</div>
		<h2 class="title"><strong>数字彩票</strong></h2>
		<table class="awardList">
			<colgroup>
				<col width="10%">
				<col width="10%">
				<col width="9%">
				<col width="29%">
				<col width="7%">
				<col width="5%">
				<col width="5%">
				<col width="5%">
				<col>
				<col width="7%">
			</colgroup>
			<thead>
			<tr>
				<th class="first">彩种</th>
				<th>期次</th>
				<th>开奖时间</th>
				<th>开奖号码</th>
				<th>头奖奖金</th>
				<th>详情</th>
				<th>走势</th>
				<th>预测</th>
				<th>投注提示</th>
				<th class="buy">购买</th>
			</tr>
			</thead>
			<tbody>
				<tr>
					<td class="first"><a href="/order/ssq/#from=kjdt">双色球</a></td>
					<td class="period"><a href="/award/ssq/2017080.html#from=kjdt">2017080期</a></td>
					<td>07-11(周二)</td>
					<td>			<em class="smallRedball">01</em>
			<em class="smallRedball">12</em>
			<em class="smallRedball">16</em>
			<em class="smallRedball">20</em>
			<em class="smallRedball">22</em>
			<em class="smallRedball">24</em>
			<em class="smallBlueball">08</em>
<a href="/award/ssq/2017080.html#anchorLink">计算奖金</a></td>
					<td>641万</td>
					<td><a href="/award/ssq/2017080.html#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/ssq/#from=kjdt">走势</a></td>
					<td><a href="http://cai.163.com/ssq/yuce/#from=kjdt">预测</a></td>
					<td>奖池：7亿6116万</td>
					<td class="buy"><a class="betBtn" href="/order/ssq/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/dlt/#from=kjdt">大乐透</a></td>
					<td class="period"><a href="/award/dlt/17080.html#from=kjdt">17080期</a></td>
					<td>昨天(周三)</td>
					<td>			<em class="smallRedball">08</em>
			<em class="smallRedball">10</em>
			<em class="smallRedball">21</em>
			<em class="smallRedball">30</em>
			<em class="smallRedball">31</em>
			<em class="smallBlueball">02</em>
			<em class="smallBlueball">05</em>
<a href="/award/dlt/17080.html#anchorLink">计算奖金</a></td>
					<td>989万</td>
					<td><a href="/award/dlt/17080.html#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/dlt/#from=kjdt">走势</a></td>
					<td><a href="http://cai.163.com/dlt/yuce/#from=kjdt">预测</a></td>
					<td>奖池：38亿6329万</td>
					<td class="buy"><a class="betBtn" href="/order/dlt/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/3d/#from=kjdt">3D</a></td>
					<td class="period"><a href="/award/3d/2017186.html#from=kjdt">2017186期</a></td>
					<td>昨天(周三)</td>
					<td>			<em class="smallRedball">0</em>
			<em class="smallRedball">3</em>
			<em class="smallRedball">3</em>
<span class="numberDis">(组三)</span><span class="extra">试机号：6 9 6</span></td>
					<td>1040</td>
					<td><a href="/award/3d/2017186.html#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/x3d/#from=kjdt">走势</a></td>
					<td><a href="http://cai.163.com/3d/yuce/#from=kjdt">预测</a></td>
					<td>直选奖金1040</td>
					<td class="buy"><a class="betBtn" href="/order/3d/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/pl3/#from=kjdt">排列3</a></td>
					<td class="period"><a href="/award/pl3/17186.html#from=kjdt">17186期</a></td>
					<td>昨天(周三)</td>
					<td>			<em class="smallRedball">9</em>
			<em class="smallRedball">6</em>
			<em class="smallRedball">7</em>
<span class="numberDis">(组六)</span></td>
					<td>1040</td>
					<td><a href="/award/pl3/17186.html#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/pl3/#from=kjdt">走势</a></td>
					<td><a href="http://cai.163.com/pl3/yuce/#from=kjdt">预测</a></td>
					<td>猜对3个号中1040元</td>
					<td class="buy"><a class="betBtn" href="/order/pl3/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/pl5/#from=kjdt">排列5</a></td>
					<td class="period"><a href="/award/pl5/17186.html#from=kjdt">17186期</a></td>
					<td>昨天(周三)</td>
					<td>			<em class="smallRedball">9</em>
			<em class="smallRedball">6</em>
			<em class="smallRedball">7</em>
			<em class="smallRedball">8</em>
			<em class="smallRedball">8</em>
</td>
					<td>10万</td>
					<td><a href="/award/pl5/17186.html#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/pl5/#from=kjdt">走势</a></td>
					<td><a href="http://cai.163.com/pl3/yuce/#from=kjdt">预测</a></td>
					<td>猜对5个号中10万</td>
					<td class="buy"><a class="betBtn" href="/order/pl5/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/qxc/#from=kjdt">七星彩</a></td>
					<td class="period"><a href="/award/qxc/17080.html#from=kjdt">17080期</a></td>
					<td>07-11(周二)</td>
					<td>			<em class="smallRedball">4</em>
			<em class="smallRedball">3</em>
			<em class="smallRedball">8</em>
			<em class="smallRedball">9</em>
			<em class="smallRedball">2</em>
			<em class="smallRedball">4</em>
			<em class="smallRedball">4</em>
</td>
					<td>无人中</td>
					<td><a href="/award/qxc/17080.html#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/qxc/#from=kjdt">走势</a></td>
					<td><a href="http://cai.163.com/pl3/yuce/#from=kjdt">预测</a></td>
					<td>奖池：1054万</td>
					<td class="buy"><a class="betBtn" href="/order/qxc/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/qlc/#from=kjdt">七乐彩</a></td>
					<td class="period"><a href="/award/qlc/2017080.html#from=kjdt">2017080期</a></td>
					<td>昨天(周三)</td>
					<td>			<em class="smallRedball">02</em>
			<em class="smallRedball">04</em>
			<em class="smallRedball">09</em>
			<em class="smallRedball">14</em>
			<em class="smallRedball">16</em>
			<em class="smallRedball">21</em>
			<em class="smallRedball">27</em>
			<em class="smallBlueball">18</em>
</td>
					<td>62万</td>
					<td><a href="/award/qlc/2017080.html#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/qlc/#from=kjdt">走势</a></td>
					<td><a href="http://cai.163.com/pl3/yuce/#from=kjdt">预测</a></td>
					<td></td>
					<td class="buy"><a class="betBtn" href="/order/qlc/#from=kjdt">投注</a></td>
				</tr>
			</tbody>
		</table>
		<h2 class="title"><strong>竞技体育</strong></h2>
		<table class="awardList">
			<colgroup>
				<col width="10%">
				<col width="10%">
				<col width="9%">
				<col width="29%">
				<col width="7%">
				<col width="5%">
				<col width="5%">
				<col width="5%">
				<col>
				<col width="7%">
			</colgroup>
			<thead>
			<tr>
				<th class="first">彩种</th>
				<th>期次</th>
				<th>开奖时间</th>
				<th>开奖号码</th>
				<th>头奖奖金</th>
				<th>详情</th>
				<th>资料库</th>
				<th>预测</th>
				<th>投注提示</th>
				<th class="buy">购买</th>
			</tr>
			</thead>
			<tbody>
				<tr>
					<td class="first"><a href="/order/sfc/#from=kjdt">胜负彩</a></td>
					<td class="period"><a href="/award/sfc/17095.html#from=kjdt">17095期</a></td>
					<td>昨天(周三)</td>
					<td><strong class="winNum">0 3 3 3 1 3 0 3 1 0 3 0 1 0</strong>
                    </td>
					<td>15万</td>
					<td><a href="/award/sfc/17095.html#from=kjdt">详情</a></td>
					<td><a href="http://zx.caipiao.163.com/football/league.html#from=kjdt">资料库</a></td>
					<td><a href="http://cai.163.com/sfc/yuce/#from=kjdt">预测</a></td>
					<td>单注最高奖金500万</td>
					<td class="buy"><a class="betBtn" href="/order/sfc/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/rx9/#from=kjdt">任选九</a></td>
					<td class="period"><a href="/award/rx9/17095.html#from=kjdt">17095期</a></td>
					<td>昨天(周三)</td>
					<td><strong class="winNum">0 3 3 3 1 3 0 3 1 0 3 0 1 0</strong>
                    </td>
					<td>623</td>
					<td><a href="/award/rx9/17095.html#from=kjdt">详情</a></td>
					<td><a href="http://zx.caipiao.163.com/football/league.html#from=kjdt">资料库</a></td>
					<td><a href="http://cai.163.com/sfc/yuce/#from=kjdt">预测</a></td>
					<td>单注最高奖金500万</td>
					<td class="buy"><a class="betBtn" href="/order/rx9/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/bqc/#from=kjdt"></a></td>
					<td class="period"></td>
					<td></td>
					<td><strong class="winNum"></strong>
                    </td>
					<td></td>
					<td><a href="#from=kjdt">详情</a></td>
					<td><a href="http://zx.caipiao.163.com/football/league.html#from=kjdt">资料库</a></td>
					<td><a href="http://cai.163.com/sfc/yuce/#from=kjdt">预测</a></td>
					<td></td>
					<td class="buy"><a class="betBtn" href="/order/bqc/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/f4cjq/#from=kjdt"></a></td>
					<td class="period"></td>
					<td></td>
					<td><strong class="winNum"></strong>
                    </td>
					<td></td>
					<td><a href="#from=kjdt">详情</a></td>
					<td><a href="http://zx.caipiao.163.com/football/league.html#from=kjdt">资料库</a></td>
					<td><a href="http://cai.163.com/sfc/yuce/#from=kjdt">预测</a></td>
					<td></td>
					<td class="buy"><a class="betBtn" href="/order/f4cjq/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/dc/#from=kjdt">足球单场</a></td>
					<td class="period"><a href="/award/dcspf/?period=70702#from=kjdt">70702期</a></td>
					<td>07-11(周二)</td>
					<td><strong class="winNum"></strong><span class="awardLink"><a href="http://caipiao.163.com/award/dcspf/#from=kjdt">胜平负</a><a href="http://caipiao.163.com/award/dcbf.html#from=kjdt">比分</a><a href="http://caipiao.163.com/award/dcbqcspf.html#from=kjdt">半全场</a><a href="http://caipiao.163.com/award/dczjq.html#from=kjdt">总进球</a></span>
                    </td>
					<td></td>
					<td><a href="/award/dcspf/?period=70702#from=kjdt">详情</a></td>
					<td><a href="http://zx.caipiao.163.com/football/league.html#from=kjdt">资料库</a></td>
					<td><a href="http://cai.163.com/zx/more_league.html#from=kjdt">预测</a></td>
					<td>猜对一场也有奖</td>
					<td class="buy"><a class="betBtn" href="/order/dc/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/sfgg/#from=kjdt">胜负过关</a></td>
					<td class="period"><a href="/award/sfgg/?period=70702#from=kjdt">70702期</a></td>
					<td>07-11(周二)</td>
					<td>排球、网球、羽毛球等更多体育赛事竞猜！
                    	</td>
					<td></td>
					<td><a href="/award/sfgg/?period=70702#from=kjdt">详情</a></td>
					<td><a href="http://zx.caipiao.163.com/football/league.html#from=kjdt">资料库</a></td>
					<td><a href="http://cai.163.com/zx/more_league.html#from=kjdt">预测</a></td>
					<td></td>
					<td class="buy"><a class="betBtn" href="/order/sfgg/#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/preBet_jczqspfmixp.html#from=kjdt">竞彩足球</a></td>
					<td class="period"></td>
					<td>不定期</td>
					<td><strong class="winNum"></strong><span class="awardLink"><a href="http://caipiao.163.com/award/jczqspfp.html#from=kjdt">胜平负</a><a href="http://caipiao.163.com/award/jczqbfp.html#from=kjdt">比分</a><a href="http://caipiao.163.com/award/jczqbcspfp.html#from=kjdt">半全场</a><a href="http://caipiao.163.com/award/jczqzjqp.html#from=kjdt">总进球</a></span>
                    </td>
					<td></td>
					<td><a href="/award/jczqspfp.html?category=all#from=kjdt">详情</a></td>
					<td><a href="http://zx.caipiao.163.com/football/league.html#from=kjdt">资料库</a></td>
					<td><a href="http://cai.163.com/zx/more_league.html#from=kjdt">预测</a></td>
					<td>玩2串1特别好中奖</td>
					<td class="buy"><a class="betBtn" href="/order/preBet_jczqspfmixp.html#from=kjdt">投注</a></td>
				</tr>
				<tr>
					<td class="first"><a href="/order/jclq/#from=kjdt">竞彩篮球</a></td>
					<td class="period"></td>
					<td>不定期</td>
					<td><strong class="winNum"></strong><span class="awardLink"><a href="http://caipiao.163.com/award/jclqsfp.html#from=kjdt">胜负</a><a href="http://caipiao.163.com/award/jclqrfsfp.html#from=kjdt">让分胜负</a><a href="http://caipiao.163.com/award/jclqdxfcp.html#from=kjdt">大小分</a><a href="http://caipiao.163.com/award/jclqsfcp.html#from=kjdt">胜分差</a></span>
                    </td>
					<td></td>
					<td><a href="/award/jclqsfp.html?category=all#from=kjdt">详情</a></td>
					<td></td>
					<td></td>
					<td>玩2串1特别好中奖</td>
					<td class="buy"><a class="betBtn" href="/order/jclq/#from=kjdt">投注</a></td>
				</tr>
			</tbody>
		</table>
		<h2 class="title"><strong>高频彩</strong></h2>
		<table class="awardList">
			<colgroup>
				<col width="10%">
				<col width="10%">
				<col width="9%">
				<col width="29%">
				<col width="7%">
				<col width="5%">
				<col width="5%">
				<col width="5%">
				<col>
				<col width="7%">
			</colgroup>
			<thead>
			<tr>
				<th class="first">彩种</th>
				<th>期次</th>
				<th>开奖时间</th>
				<th>开奖号码</th>
				<th>热门玩法</th>
				<th>详情</th>
				<th>走势</th>
				<th>论坛</th>
				<th>投注提示</th>
				<th class="buy">购买</th>
			</tr>
			</thead>
			<tbody>
				<tr >
					<td class="first"><a href="/order/11xuan5/#from=kjdt">11选5</a></td>
					<td class="period"><a href="/award/11xuan5/#from=kjdt">17071349期</a></td>
					<td>今天 16:35</td>
					<td >
			<em class="smallRedball">10</em>
			<em class="smallRedball">07</em>
			<em class="smallRedball">04</em>
			<em class="smallRedball">01</em>
			<em class="smallRedball">02</em>
                            
                    </td>
					<td>前一</td>
					<td><a href="/award/11xuan5/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/11xuan5/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/11x5#from=kjdt">去讨论</a></td>
					<td>猜中1个即中奖</td>
					<td class="buy"><a class="betBtn" href="/order/11xuan5/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/jx11xuan5/#from=kjdt">老11选5</a></td>
					<td class="period"><a href="/award/jx11xuan5/#from=kjdt">17071346期</a></td>
					<td>今天 16:39</td>
					<td >
			<em class="smallRedball">11</em>
			<em class="smallRedball">06</em>
			<em class="smallRedball">09</em>
			<em class="smallRedball">07</em>
			<em class="smallRedball">01</em>
                            
                    </td>
					<td>前一</td>
					<td><a href="/award/jx11xuan5/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/jx11xuan5/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/11x5#from=kjdt">去讨论</a></td>
					<td>猜中1个即中奖</td>
					<td class="buy"><a class="betBtn" href="/order/jx11xuan5/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/gd11xuan5/#from=kjdt">粤11选5</a></td>
					<td class="period"><a href="/award/gd11xuan5/#from=kjdt">17071346期</a></td>
					<td>今天 16:40</td>
					<td >
			<em class="smallRedball">07</em>
			<em class="smallRedball">02</em>
			<em class="smallRedball">03</em>
			<em class="smallRedball">11</em>
			<em class="smallRedball">04</em>
                            
                    </td>
					<td>任五</td>
					<td><a href="/award/gd11xuan5/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/gd11xuan5/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/11x5#from=kjdt">去讨论</a></td>
					<td>猜中1个即中奖</td>
					<td class="buy"><a class="betBtn" href="/order/gd11xuan5/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/hlj11xuan5/#from=kjdt">好运11选5</a></td>
					<td class="period"><a href="/award/hlj11xuan5/#from=kjdt">17071352期</a></td>
					<td>今天 16:35</td>
					<td >
			<em class="smallRedball">07</em>
			<em class="smallRedball">10</em>
			<em class="smallRedball">09</em>
			<em class="smallRedball">01</em>
			<em class="smallRedball">03</em>
                            
                    </td>
					<td>任二</td>
					<td><a href="/award/hlj11xuan5/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/hlj11xuan5/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/11x5#from=kjdt">去讨论</a></td>
					<td>简单易中</td>
					<td class="buy"><a class="betBtn" href="/order/hlj11xuan5/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/zj11xuan5/#from=kjdt">易乐11选5</a></td>
					<td class="period"><a href="/award/zj11xuan5/#from=kjdt">17071349期</a></td>
					<td>今天 16:30</td>
					<td >
			<em class="smallRedball">10</em>
			<em class="smallRedball">05</em>
			<em class="smallRedball">03</em>
			<em class="smallRedball">04</em>
			<em class="smallRedball">06</em>
                            
                    </td>
					<td>任二</td>
					<td><a href="/award/zj11xuan5/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/zj11xuan5/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/11x5#from=kjdt">去讨论</a></td>
					<td></td>
					<td class="buy"><a class="betBtn" href="/order/zj11xuan5/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/kuai3/#from=kjdt">快3</a></td>
					<td class="period"><a href="/award/kuai3/#from=kjdt">170713050期</a></td>
					<td>今天 16:41</td>
					<td >
			<em class="smallRedball">2</em>
			<em class="smallRedball">3</em>
			<em class="smallRedball">3</em>
                            
                            	<span class="numberDis">和值：<strong>8</strong>&nbsp;<em class="small">小</em><em class="dual">双</em></span>
                                                </td>
					<td>和值</td>
					<td><a href="/award/kuai3/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/kuai3/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/kuai3#from=kjdt">去讨论</a></td>
					<td>简单易中</td>
					<td class="buy"><a class="betBtn" href="/order/kuai3/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/jskuai3/#from=kjdt">江苏快3</a></td>
					<td class="period"><a href="/award/jskuai3/#from=kjdt">170713049期</a></td>
					<td>今天 16:39</td>
					<td >
			<em class="smallRedball">4</em>
			<em class="smallRedball">4</em>
			<em class="smallRedball">6</em>
                            
                            	<span class="numberDis">和值：<strong>14</strong>&nbsp;<em class="big">大</em><em class="dual">双</em></span>
                                                </td>
					<td>和值</td>
					<td><a href="/award/jskuai3/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/jskuai3/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/kuai3#from=kjdt">去讨论</a></td>
					<td>简单易中</td>
					<td class="buy"><a class="betBtn" href="/order/jskuai3/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/gxkuai3/#from=kjdt">新快3</a></td>
					<td class="period"><a href="/award/gxkuai3/#from=kjdt">20170713043期</a></td>
					<td>今天 16:37</td>
					<td >
			<em class="smallRedball">2</em>
			<em class="smallRedball">5</em>
			<em class="smallRedball">6</em>
                            
                            	<span class="numberDis">和值：<strong>13</strong>&nbsp;<em class="big">大</em><em class="odd">单</em></span>
                                                </td>
					<td>和值</td>
					<td><a href="/award/gxkuai3/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/gxkuai3/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/kuai3#from=kjdt">去讨论</a></td>
					<td>简单易中</td>
					<td class="buy"><a class="betBtn" href="/order/gxkuai3/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/hbkuai3/#from=kjdt">湖北快3</a></td>
					<td class="period"><a href="/award/hbkuai3/#from=kjdt">170713046期</a></td>
					<td>今天 16:39</td>
					<td >
			<em class="smallRedball">3</em>
			<em class="smallRedball">4</em>
			<em class="smallRedball">6</em>
                            
                            	<span class="numberDis">和值：<strong>13</strong>&nbsp;<em class="big">大</em><em class="odd">单</em></span>
                                                </td>
					<td>和值</td>
					<td><a href="/award/hbkuai3/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/hbkuai3/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/kuai3#from=kjdt">去讨论</a></td>
					<td></td>
					<td class="buy"><a class="betBtn" href="/order/hbkuai3/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/nmgkuai3/#from=kjdt">易快3</a></td>
					<td class="period"><a href="/award/nmgkuai3/#from=kjdt">170713041期</a></td>
					<td>今天 16:33</td>
					<td >
			<em class="smallRedball">1</em>
			<em class="smallRedball">2</em>
			<em class="smallRedball">4</em>
                            
                            	<span class="numberDis">和值：<strong>7</strong>&nbsp;<em class="small">小</em><em class="odd">单</em></span>
                                                </td>
					<td>和值</td>
					<td><a href="/award/nmgkuai3/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/nmgkuai3/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/kuai3#from=kjdt">去讨论</a></td>
					<td></td>
					<td class="buy"><a class="betBtn" href="/order/nmgkuai3/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/ahkuai3/#from=kjdt">好运快3</a></td>
					<td class="period"><a href="/award/ahkuai3/#from=kjdt">170713046期</a></td>
					<td>今天 16:21</td>
					<td >
			<em class="smallRedball">2</em>
			<em class="smallRedball">3</em>
			<em class="smallRedball">5</em>
                            
                            	<span class="numberDis">和值：<strong>10</strong>&nbsp;<em class="small">小</em><em class="dual">双</em></span>
                                                </td>
					<td>和值</td>
					<td><a href="/award/ahkuai3/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/ahkuai3/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/kuai3#from=kjdt">去讨论</a></td>
					<td></td>
					<td class="buy"><a class="betBtn" href="/order/ahkuai3/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/kuailepuke/#from=kjdt">快乐扑克</a></td>
					<td class="period"><a href="/award/kuailepuke/#from=kjdt">17071350期</a></td>
					<td>今天 16:40</td>
					<td class="winningNumberlist">
<span class="poker_kj_num poker_hongt"><i></i><em>2</em></span>                                <span class="poker_kj_num poker_heit"><i></i><em>3</em></span>                                <span class="poker_kj_num poker_hongt"><i></i><em>J</em></span>                                &#12288;<span class="c_727171">散牌</span>

                    </td>
					<td>包选</td>
					<td><a href="/award/kuailepuke/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/kuailepuke/">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/klpk#from=kjdt">去讨论</a></td>
					<td>边玩扑克边中奖</td>
					<td class="buy"><a class="betBtn" href="/order/kuailepuke/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/cqssc/#from=kjdt">重庆时时彩</a></td>
					<td class="period"><a href="/award/ssc/#from=kjdt">170713064期</a></td>
					<td>今天 16:40</td>
					<td >
			<em class="smallRedball">0</em>
			<em class="smallRedball">4</em>
			<em class="smallRedball">0</em>
			<em class="smallRedball">1</em>
			<em class="smallRedball">4</em>
                            
                    </td>
					<td>三星</td>
					<td><a href="/award/ssc/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/cqssc/jiben-2xing.html">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/ssc#from=kjdt">去讨论</a></td>
					<td>简单易中</td>
					<td class="buy"><a class="betBtn" href="/order/cqssc/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/jxssc/#from=kjdt">新时时彩</a></td>
					<td class="period"><a href="/award/jxssc/#from=kjdt">20160222084期</a></td>
					<td>02-22 23:00</td>
					<td >
			<em class="smallRedball">3</em>
			<em class="smallRedball">1</em>
			<em class="smallRedball">6</em>
			<em class="smallRedball">6</em>
			<em class="smallRedball">8</em>
                            
                    </td>
					<td>三星</td>
					<td><a href="/award/jxssc/#from=kjdt">详情</a></td>
					<td><a href="http://trend.caipiao.163.com/jxssc/jiben-2xing.html">走势</a></td>
					<td><a href="http://bbs.caipiao.163.com/ssc#from=kjdt">去讨论</a></td>
					<td>简单易中</td>
					<td class="buy"><a class="betBtn" href="/order/jxssc/#from=kjdt">投注</a></td>
				</tr>
				<tr >
					<td class="first"><a href="/order/kl8/#from=kjdt">快乐8</a></td>
					<td class="period"><a href="/award/kl8/833954.html#from=kjdt">833954期</a></td>
					<td>今天 16:30</td>
					<td >
<span class="kl8Num">01 04 08 11 14 20 25 30 39 41 48 51 53 54 59 62 71 72 73 75</span><span  class="kl8Fp">飞盘&times;10</span>
                    </td>
					<td>任选二</td>
					<td><a href="/award/kl8/833954.html#from=kjdt">详情</a></td>
					<td></td>
					<td></td>
					<td>10分钟一个500万</td>
					<td class="buy"><a class="betBtn" href="/order/kl8/#from=kjdt">投注</a></td>
				</tr>
				<tr class="noborder">
					<td class="first"><a href="/order/gdklsf/#from=kjdt">粤快乐十分</a></td>
					<td class="period"><a href="/award/gdklsf/#from=kjdt">17071346期</a></td>
					<td>今天 16:10</td>
					<td >
			<em class="smallRedball">07</em>
			<em class="smallRedball">01</em>
			<em class="smallRedball">18</em>
			<em class="smallRedball">11</em>
			<em class="smallRedball">19</em>
			<em class="smallRedball">15</em>
			<em class="smallRedball">08</em>
			<em class="smallRedball">03</em>
                            
                    </td>
					<td>任选二</td>
					<td><a href="/award/gdklsf/#from=kjdt">详情</a></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="buy"><a class="betBtn" href="/order/gdklsf/#from=kjdt">投注</a></td>
				</tr>
			</tbody>
		</table>
	</section >
</article>
<script>
//手机客户端
jQuery(function(){Core.insertMobDownFix();});
</script>
<div class="hot_block seohot_block clearfix">
    <h2 class="hot_title" id=\'seohotNav\'>
    	<em rel=\'#hot_block\' class="active">热点导航</em>
    	<em rel=\'#sport_block\' >体育赛事</em>
    </h2>
    <p id="hot_block">    
	<a target="_blank" href="http://888.163.com/" title="网易一元购">网易一元购</a>
	<a target="_blank" href="http://cai.163.com/ssq/yuce/" >福彩双色球开奖结果</a>
	<a target="_blank" href="http://cai.163.com/dlt/yuce/" >大乐透</a>
	<a target="_blank" href="http://bbs.caipiao.163.com/60632.html#from=search" >疯狂星期四</a>
	<a target="_blank" href="http://trend.caipiao.163.com/" title="彩票走势图">彩票走势图</a>
	<a target="_blank" href="http://caipiao.163.com/award/zjkuaile12/" title="快乐12开奖结果">快乐12</a>
	<a target="_blank" href="http://g.caipiao.163.com/activity/CouponPushIndexPc.html#from=search1" title="1元欢乐购">1元欢乐购活动</a>
	<a target="_blank" href="http://caipiao.163.com/order/11xuan5/" title="体彩11选5">11选5</a>
	<a target="_blank" href="http://caipiao.163.com/nfop/yiyuanhlg/index.htm#from=search1" >1元欢乐购</a>
	<a target="_blank" href="http://caipiao.163.com/order/" title="网上购彩">彩票投注</a>
	<a target="_blank" href="http://caipiao.163.com/order/dlt/" title="体彩超级大乐透">体彩大乐透</a>
	<a target="_blank" href="http://caipiao.163.com/order/pl3/" title="体彩排列3">排列三</a>
	<a target="_blank" href="http://trend.caipiao.163.com/x3d/" title="福彩3d走势图">3d走势图</a>
	<a target="_blank" href="http://trend.caipiao.163.com/pl5/" title="体彩排列5走势图">排列五走势图</a>
	<a target="_blank" href="http://caipiao.163.com/groupbuy/ " >彩票合买</a>
	<a target="_blank" href="http://trend.caipiao.163.com/kuai3/" title="福彩快3走势图">快3走势图</a>
	<a target="_blank" href="http://trend.caipiao.163.com/dlt/" title="超级大乐透走势图">大乐透走势图</a>
	<a target="_blank" href="http://caipiao.163.com/order/qlc/" title="福彩七乐彩">七乐彩</a>
	<a target="_blank" href="http://caipiao.163.com/order/3d/ " title="福利彩票3d">3D</a>
	<a target="_blank" href="http://caipiao.163.com/order/pl5/" title="体彩排列5">排列五</a>
	<a target="_blank" href="http://trend.caipiao.163.com/ln11xuan5/" title="辽宁11选5走势图">辽宁11选5</a>
	<a target="_blank" href="http://trend.caipiao.163.com/cq11xuan5/ " title="重庆11选5走势图">重庆11选5</a>
	<a target="_blank" href="https://itunes.apple.com/cn/app/le-cai-piao-wang-yi-zu-cai/id618888447" >网易乐得彩票</a>
	<a target="_blank" href="https://itunes.apple.com/cn/app/wang-yi-cai-piao-ji-su-ban/id687634749" >网易彩票极速版软件</a>
	<a target="_blank" href="https://itunes.apple.com/cn/app/zha-jin-hua-feng-kuang-ying/id966473019?mt=8" >疯狂赢三张</a>
	<a target="_blank" href="http://mall.163.com/m/index.html" >网易电商</a>
	<a target="_blank" href="https://itunes.apple.com/cn/app/wang-yi-gui-jin-shu-huang/id936553438?mt=8" >贵金属</a>
	<a target="_blank" href="http://www.kaola.com/" >海外直邮</a>
<a rel="nofollow" class="showmore" href="javascript:void(0)" >更多&gt;&gt;</a>
	</p>
	<p id="sport_block"style="display:none">
	<a target="_blank" href="http://live.caipiao.163.com/#from=search" >竞彩比分直播</a>
	<a target="_blank" href="http://live.caipiao.163.com/#from=search" title="足球联赛资料">足球资料库</a>
	<a target="_blank" href="http://live.caipiao.163.com/#from=search" title="赔率中心">赔率</a>
	<a target="_blank" href="http:/vs.caipiao.163.com/#from=search" title="vs足球对阵">VS</a>
	<a target="_blank" href="http://live.caipiao.163.com/#from=search" title="篮彩预测分析推荐">篮球资料库</a>
<a rel="nofollow" class="showmore" href="javascript:void(0)" >更多&gt;&gt;</a>
	</p>
</div>
<footer id="docFoot">
	<ul id="guideList">
		<li class="first"><em class="guide_1"></em>
        <em class="guide_1_con"></em>
        </li>
		<li><em class="guide_2"></em><span>
			&middot; <a target="_blank" href="http://caipiao.163.com/help/special/00754IHC/caipiao_help_index.html" title="购彩流程">购彩流程</a><br />
			&middot; <a target="_blank" href="http://caipiao.163.com/help/10/0726/16/6CHGN51T00754IHQ.html" title="领奖流程">领奖流程</a><br />
			&middot; <a target="_blank" href="https://epay.163.com/index.jsp" rel="nofollow">开通网易支付</a><br />
			&middot; <a target="_blank" href="https://epay.163.com/charge/chargeView.htm?from=caipiao" rel="nofollow">网易支付充值</a>
		</span></li>
        <li><em class="guide_3"></em><span>
			&middot; <a target="_blank" href="http://caipiao.163.com/imghelp/tz_pt_1.jsp" title="新手购彩图解">新手购彩图解</a><br /> 
			&middot; <a target="_blank" href="http://caipiao.163.com/help/special/00754II5/caipiao_qa_guide.html" title="常见问题">常见问题</a><br />
			&middot; <a target="_blank" href="http://caipiao.163.com/help/special/00754IHC/caipiao_help_index.html" title="功能指引">功能指引</a><br />
			&middot; <a target="_blank" href="http://caipiao.163.com/help/special/00754IHC/caipiao_help_index.html" title="彩种介绍">彩种介绍</a>		</span></li>
		<li><em class="guide_4"></em><span>
			&middot; <a target="_blank" href="http://caipiao.163.com/help/10/0726/16/6CHHOPF900754IHP.html" rel="nofollow">网易支付</a><br />
			&middot; <a target="_blank" href="http://caipiao.163.com/help/10/0726/17/6CHLJHB100754IHP.html" rel="nofollow">网银支付</a><br />
			&middot; <a target="_blank" href="http://caipiao.163.com/help/10/0726/17/6CHLRB7600754IHP.html" rel="nofollow">支付宝支付</a><br />
			&middot; <a target="_blank" href="http://caipiao.163.com/help/10/0726/17/6CHM0HIM00754IHP.html" rel="nofollow">手机充值卡支付</a>
		</span></li>
        <li><em class="guide_5"></em><span>
			&middot; <a target="_blank" href="http://caipiao.163.com/">彩票</a>&nbsp;
            <a target="_blank" href="http://piao.163.com/#from=cp_footer">电影票</a><br />
            &middot; <a target="_blank" href="http://baoxian.163.com/?from=cp_footer">保险</a>&nbsp;
            <a target="_blank" href="http://trip.163.com/#from=cp_footer">火车票</a><br />
            &middot; <a target="_blank" href="http://mm.163.com/#from=cp_footer">美美</a>&nbsp;
            <a target="_blank" href="http://yxp.163.com/#from=cp_footer">印像派</a><br />
	        &middot; <a target="_blank" href="http://mall.163.com/#from=cp_footer">商城</a>&nbsp;
            <a target="_blank" href="http://888.163.com/?from=caipiao">1元购</a>
		</span></li>
	</ul>
	<div id="aboutNEST">
<a href="http://corp.163.com/eng/about/overview.html" rel="nofollow">About NetEase</a> - <a href="http://gb.corp.163.com/gb/about/overview.html" rel="nofollow">公司简介</a> - <a href="http://gb.corp.163.com/gb/contactus.html" rel="nofollow">联系方法</a> - <a href="http://corp.163.com/gb/job/job.html" rel="nofollow">招聘信息</a> - <a href="http://help.163.com/" rel="nofollow">客户服务</a> - <a href="http://gb.corp.163.com/gb/legal.html" rel="nofollow">隐私政策</a> - <a href="http://emarketing.163.com/" rel="nofollow">网络营销</a> - <a href="http://caipiao.163.com/sitemap.htm">网站地图</a> - <a href="http://caipiao.163.com/" title="网易彩票网">网易彩票网</a><br/>增值电信业务经营许可证：浙B2-20110418  |  <a href="http://www.lede.com/prove.html">网站相关资质证明</a> <br />
  网易旗下乐得公司版权所有 &copy;2011-2017<br/>网易彩票提醒您：理性购彩，热心公益。未满18周岁的未成年人禁止购彩及兑奖！
	</div>
<div id="seoFriendlyLink"  class="friendlyLink">
	<h3>
		<strong>友情链接：</strong>		
	</h3>
	<ul>
		<li ><a target="_blank" href="http://caipiao.163.com/help/special/rule/" title="彩票大全">彩票大全</a></li>
		<li ><a target="_blank" href="http://sports.163.com/special/2016europeancuplottery/" title="欧洲杯">欧洲杯</a></li>
		<li ><a target="_blank" href="http://caipiao.163.com/nfop/2016ouzhoubei/index.htm" title="欧洲杯触屏版">欧洲杯触屏版</a></li>
		<li ><a target="_blank" href="http://www.kaola.com/how/4494.html" title="考拉">考拉</a></li>
	</ul>
</div>
</footer>
<script>Core && Core.fastInit && Core.fastInit("1");</script>
<script src="http://analytics.163.com/ntes.js"></script>
<script>try{_ntes_nacc=window.top===window.self?"caipiao":"cpiframe";neteaseTracker();neteaseClickStat();}catch(e){}</script>
<script>!function(t){function n(){}function i(){var t=Math.round((+new Date-N)/1e3);return 0>t?0:t}function e(t){var n=t.className,i=d(t),e={script:1,style:1,link:1,img:1,hr:1,br:1},o=!0;return e[i]?o=!1:/blank\d/.test(n)&&(o=!1),o}function o(n){_||(v&&window._ntes_sendInfo?(t.each(g,function(t,n){u(n)}),_=!0):g.push(n)),_&&u(n)}function a(t){return 10>t?t.toString():t>62?"z":String.fromCharCode(t+(36>t?55:61))}function r(t,n){if(!n)return t;var i=t.length-1,e=t.charCodeAt(i);return 58>e?e-=48:91>e?e-=55:123>e&&(e-=61),t.substr(0,i)+a(e+n)}function c(t,n,i){n&&n.setAttribute((i?"_":"")+"jcid",t)}function f(t){if(t){var n=this.getAttribute("href")||"";m++;var e="/ntes_p?"+b+"&_nct="+i()+"&_nah="+escape(n)+"&_nat={id}_"+t;o(e)}}function u(t){_ntes_sendInfo("jc",_ntes_src_addr+t.replace("{id}",v))}function s(t,n,i){for(var e=0,o={a:1,area:1};!o[d(t)]&&!(i=t.getAttribute("_jcid"));)if(t=t.parentNode,!t.tagName||e++>5)return;var a=t;if(!i)for(;t&&t!=n&&!(i=t.getAttribute("jcid"));)t=t.parentNode;a&&i&&f.call(a,i)}function d(t){return t.tagName.toLowerCase()}function l(n,i,e){if("iframe"!=d(n))i(n,e);else{var o,a=h(n),r=function(){if("function"==typeof o&&o.call(this),a=h(n)){var r=a.body;t(r).click(function(t){var n=t.target;s(n,r)}),i(r,e)}};a&&/^http/.test(a.location.href)?r():n.attachEvent?n.attachEvent("onload",r):(o=n.onload,n.onload=r)}}function h(t){var n;try{n=t.contentDocument}catch(i){}if(!n&&t.contentWindow){try{var e=t.contentWindow.document;"object"==typeof e&&(n=e)}catch(i){}if(!n)return null}var o=1;try{n.location&&(o=0)}catch(i){}return o?null:n}var v,p,b="_nacc=siteclick&_npurl="+escape(document.URL),m=0,_=!1,g=[],w=document.body,y=t(window),A=window.performance,N=A&&A.timing?A.timing.connectStart:+new Date,j=[function(t,n,i){c(t+a(i.start||1),n,i.all)},function(n,i,e){var o=e.start||1;t("a",i).each(function(t,i){c(n+a(o++),i)})},function(n,i,o){for(var r=1,f=o.level||1,u=[i],s=0;f>s;s++){var l=[];t.each(u,function(n,i){var o=0;"a"==d(i)||/ntes-nav-select/.test(i.className)||t.each(i.children,function(t,n){e(n)&&(l.push(n),o++)}),o||l.push(i)}),u=l}t.each(u,function(t,i){c(n+a(r++),i)})},function(n,i){var e=t(">form",i);e[0]&&e.bind("submit",function(){f.call(this,n+"1")})},function(n,i,e){var o=t(e.h,i),r=t(e.b,i);if(o&&r){var f=e.step||10,u=2;c(n+"1",i),o.each(function(t,i){c(n+a(u+t*f),i)}),r.each(function(t,i){c(n+a(u+t*f+1),i)})}},function(n,i,o){var r=o.union||"",f={};if(/^[\s\d,]+$/.test(r)){var u=0;t.each(r.split(/\s*,\s*/),function(t,n){if(n=parseInt(n))for(var i=0;n>i;i++)f[u++]=t})}var s=2;c(n+"1",i);var d=parseInt(o.step)||10,l=t(o.h,i);if(l&&h){t.each(l,function(t,i){c(n+a(t*d+s),i)});var h=t(o.b,i);t.each(h,function(i,o){var r=i*d+s+1,u=o.children;if(0==u.length)u=[o];else for(;1==u.length;)u=u[0].children;var l=0;t.each(u,function(t,i){e(i)&&("undefined"!=typeof f[t]&&(l=f[t]),c(n+a(r+l),i),l++)})})}}];n.prototype={init:function(n,e){n&&5==n.length&&(v=n),p||(p=Math.random()<(e||.1),p&&(t("body").bind("click",function(t){s(t.target,w)}),t(function(){function t(){n&&(o("/ntes_u?"+n+"&_nct="+i()+"&_mcn="+m+e),n=0)}var n=b+"&_nch={id}",e="",a="&_msl="+i();y.bind("load",function(){e="&_msl="+i()}),o("/ntes_u?"+n+a),y.bind("beforeunload",t);var r=navigator.userAgent.toLowerCase();!/compatible/.test(r)&&/firefox/.test(r)&&y.bind("unload",t)}),this.retain&&this.area(w,this.retain)))},area:function(t,n){for(var i in n){var e=0,o=n[i];/(.*?)=$/.test(i)&&(i=RegExp.$1,e=1e3),this.procA(t,i,o,e)}},procA:function(n,i,e,o){var a=this;if(o)return setTimeout(function(){a.procA(n,i,e)},o),void 0;var r=function(t,n){a.area(t,n)},c=0,f=0;/(.*?)!$/.test(i)&&(i=RegExp.$1,f=1),/(.*?)\*$/.test(i)&&(i=RegExp.$1,c=1);var u,s=i?/^#/.test(i)?t(i):t(i,n):[n],d=0;for(u=0;u<s.length;u++){var h=s[u];if(!f||!h.id){var v=c?e[0]:e[d];if(v&&h)if(v.i)for(var p=v.s||1,b=0;p>b;b++)v.j=b,this.zone(s[u+b],v);else l(h,r,v);d++}}},zone:function(n,i){var e=r(i.i,i.j),o=j[i.f||0],a=i.p||{};n&&o&&(a.dyn?t(n).bind("mouseover",function(){for(var t,i=n.children[0];i&&(t=i.children[0]);)i=t;i&&!i.getAttribute("jdyn")&&(o(e,n,a),i.setAttribute("jdyn",1))}):l(n,function(t){o(e,t,a)}))},batch:function(t){p?this.area(w,t):this.retain=t}},window._aCM=new n}(jQuery),function(){_aCM.init("cpp44"),setTimeout(function(){_aCM.batch({"#topNav":[{"#topNavLeft":[{"":[{i:"111",f:1}]}],li:[{"":[{i:"121"}]},{".topNavHolder":[{i:"131"}]},{".topNavHolder":[{i:"141"}],".mcDropMenu":[{i:"142",f:1}]},{".topNavHolder":[{i:"151"}],".mcDropMenu":[{i:"152",f:1}]},{"":[{i:"161"}]},{".topNavHolder":[{i:"171"}],".mcDropMenu":[{i:"172",f:1}]}]}],"#docHead":[{"#docHeadWrap":[{"":[{i:"211",f:1}]}]}],"#topTabBox":[{"":[{"":[{i:"311",f:2,p:{level:3}}]}]}],">.docBody":[{">.breadCrumb":[{"":[{i:"411"}]}],">.popuBox":[{"":[{i:"421"}]}],".title":[{">span":[{i:"431",f:1}]}],".todayAward":[{">.detail":[{i:"441",f:1}],">.links":[{i:"442",f:1}]}],".awardList":[{tr:[0,{i:"451",f:1},{i:"452",f:1},{i:"453",f:1},{i:"454",f:1},{i:"455",f:1},{i:"456",f:1},{i:"457",f:1}]},{tr:[0,{i:"461",f:1},{i:"462",f:1},{i:"463",f:1},{i:"464",f:1},{i:"465",f:1},{i:"466",f:1},{i:"467",f:1}]},{tr:[0,{i:"471",f:1},{i:"472",f:1},{i:"473",f:1},{i:"474",f:1},{i:"475",f:1},{i:"476",f:1},{i:"477",f:1},{i:"478",f:1},{i:"479",f:1}],".noborder":[{i:"47A",f:1}]}]}],">.hot_block":[{"#hot_block":[{"":[{i:"511"}]}]}],"#docFoot":[{span:[{"":[{i:"611",f:1}]},{"":[{i:"621",f:1}]},{"":[{i:"631",f:1}]},{"":[{i:"641",f:1}]}],"#aboutNEST":[{"":[{i:"651",f:1}]}]}],".content":[{h2:[{"":[{i:"711"}]}],".code":[{"":[{i:"721"}]}]}]})},50)}();</script>
<!-- big data analysis -->
<script src="http://img1.cache.netease.com/f2e/products/analysis/js/analysis.UAcyP13Kjxy9.4.js"></script></body>
</html>';
    }
}
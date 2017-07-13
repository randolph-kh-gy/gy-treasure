<?php

namespace Tests\Unit\Fetcher\RemoteApi\Cp360Cn\Kj;

use GyTreasure\Fetcher\RemoteApi\Cp360Cn\Kj\HallHtmlTableParser;
use PHPUnit\Framework\TestCase;

class HallHtmlTableParserTest extends TestCase
{
    public function testParse()
    {
        $parser         = new HallHtmlTableParser();
        $returnArray    = $parser->parse($this->_html());

        $this->assertEquals('2017186', $returnArray['sd'][0]['issue']);
        $this->assertEquals(['0', '3', '3'], $returnArray['sd'][0]['winningNumbers']);

        $this->assertEquals('2017186', $returnArray['p3'][0]['issue']);
        $this->assertEquals(['9', '6', '7'], $returnArray['p3'][0]['winningNumbers']);
    }

    private function _html() {
        return '<!DOCTYPE html>
<!--[if lte IE 6]><html class="ie6 oldie" id="ie6" lang="zh"><![endif]-->
<!--[if IE 7]><html class="ie7 oldie" id="ie7"  lang="zh"><![endif]-->
<!--[if IE 8]><html class="ie8 oldie" id="ie8"  lang="zh"><![endif]-->
<!--[if IE 9]><html class="ie9" lang="zh"><![endif]-->
<!--[if !(IE)]><!-->
<html  class="notie" lang="zh">
    <!--<![endif]-->
    <head>
        <meta charset="GBK" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="Keywords" content="彩票开奖,开奖结果,开奖号码,3D试机号,360彩票" />
        <meta name="Description" content="【360彩票】全国开奖中心公布福彩、体彩、足彩和高频彩等彩种的开奖结果。包括：双色球、大乐透、3D、排列三、排列五、七乐彩、七星彩、胜负彩等彩种的开奖结果查询。" />
        <meta name="author" content="360彩票(cp.360.cn)" />
        <meta name="copyright" content="Copyright @cp.360.cn 版权所有" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="renderer" content="webkit" />
        <base target="_self" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <link rel="apple-touch-icon-precomposed" href="http://p2.qhimg.com/t01b0f56b331d358632.png" />
        <link rel="apple-touch-icon" href="http://p2.qhimg.com/t01b0f56b331d358632.png" />
        <title>【全国开奖】开奖结果_开奖公告_开奖查询_开奖号码_360彩票_安全购彩</title>
        <link rel="icon" type="image/vnd.microsoft.icon" href="/favicon.ico"/>
        <link rel="stylesheet" href="http://s0.cp.360.cn/trade/2013/static/v1/css/src/reset.css" />
<link rel="stylesheet" href="http://s0.cp.360.cn/trade/merge/i6Fzam6N7fIj.css?v1.0.62.css" />
<link rel="stylesheet" href="http://s0.cp.360.cn/trade/2013/static/v1/css/kaijiang/mod.kaij-news.css?v1.0.62.css" />
        <script type="text/javascript">
            window.config_360cp = {
                sys_time : \'1499917803\',
                act_url:\'http://huodong.cp.360.cn/\',
                cp_url:\'http://cp.360.cn\',
                chart_url:\'http://chart.cp.360.cn\',
                odds_url:\'http://odds.cp.360.cn\',
                ssl_login : 1,
                ssl_login_url : \'https://cp.360.cn\', //登录注册，支付
                login_url : \'http://cp.360.cn\', //登录注册，支付
                ssl_reg : 1,
                ssl_reg_url : \'https://cp.360.cn\',
                reg_url : \'http://cp.360.cn\',
                ssl_pay : 1,
                ssl_pay_url : \'https://cp.360.cn\'
            };
                        document.oldwrite = document.write;
        </script>
        <!--[if IE 6]>
        <script>document.execCommand(\'BackgroundImageCache\', false, true); </script>
        <![endif]-->
		
            </head>

<body class="bg">
    <!-- top -->
    <style type="text/css">
	body{background:#fff url(/2013/static/v1/img/index/20141215/index-bodybg.png) no-repeat top center;}
	
	.add-active{ background:#cc323c;width:100%;height:100px; overflow:hidden;}
	.add-active .rel{ position:relative; width:988px; margin-left:-494px; left:50%;top;0px}
	.add-active a{ display: block; width:988px;left:0px;height:100px; background:url(http://p9.qhimg.com/t017f7be46e259104a3.png) no-repeat; position:absolute;top:0px;}
	.add-active span{ position:absolute; right:40px;top:5px;color:#fff; cursor:pointer}
	
	
</style>
<!-- 公共头部的广告位 -->
<div class="add-active" style="display:none">
	<div class="rel">
		<a href="http://huodong.cp.360.cn/newuser" target="_blank"></a>		
	</div>
	<span onclick="$(\'.add-active\').remove();$(\'#liansai-wrap\').css(\'top\',124);">关闭</span>
</div><div class="home-header clearfix" id="hd" style="height:84px; background:none;border:none;box-shadow:none">
	<!-- 春节logo类名newlogo -->
	<a class="logo" alt="360彩票 安全购彩 就上360" href="/?logo" target="_self">360彩票 安全购彩 就上360</a>
	<div class="head-ad none"><a href="http://zqb.360.cn/olympic2016/hot" style=""><img src="http://p4.qhimg.com/t0182b3b30b30d60141.png"></a></div>	    <div class="nav-login" id="passport_login_box">
             <div class="login passport_login_box" style="display: block">
            <a href="#" class="passport_login">我的彩票</a><span class="divider">|</span><a href="#" class="passport_login">登录</a><span class="divider">|</span><a href="#" class="passport_reg">注册</a>
        </div>
        <div class="logined passport_logined_box" style="display: none">
            <a href="/pfbet/" target="_blank"><i class="ico ico-user"></i><span class="passport_username" email=""></span></a>&nbsp;
            <a href="/pfmessage/" target="_blank" style="font-size: 12px;display: none"><i class="ico ico-msg"></i> (<em class="passport_msg_count "></em>)</a>
            <span class="divider">|</span>
            <div class="dropdown" id="mycp">
                <a class="dropdown-toggle" href="/pfbet/"><span>我的彩票</span><span class="caret"></span></a>
            </div><span class="divider">|</span><a href="/user/logout/" target="_self">退出</a>
        </div>
        <div class="dropdown dropdown-active" id="mycpactive" style="display: none;">
            <a class="dropdown-toggle mycp2" href="/pfbet/" target="_blank"><span>我的彩票</span><span class="caret caret-open"></span></a>
            <div class="dropdown-menu" style="margin-top: -1px;">
                <div class="mod-my-cp-dlg">
                    <div class="base-info">
                        <p>资金概况：<img id="money_loading" src="http://p4.qhimg.com/t01d75074755ea9e041.gif" style="vertical-align:middle;" /></p>
                        <ul class="list">
                            <li><span class="k">账户总额：</span><span class="v"><b class="em money_all">0.00</b> 元</span> <a href="/pfchongzhi/" target="_blank" class="btn-middle btn-middle-primary">充值</a></li>
                            <li><span class="k">可用现金：</span><span class="k"><b class="money_xianjin">0</b> 元</span></li>
                            <li><span class="k">通用红包：</span><span class="k"><b class="money_hongbao">0</b> 元</span></li>
                            <li><span class="k">活动红包：</span><span class="k"><a href="/pfhongbao/?idx=1"><b class="money_active_hongbao gray999">0</b> 个</a></span></li>
                            <li><span class="k">当前积分：</span><span class="k"><b class="money_jifen">0</b> 个</span></li>
                            <li><span class="k">提款申请：</span><span class="v"><b class="k money_tikuan">暂无</b><span class="divider">|</span><a class="lnk" href="/pftikuan/" target="_blank">提款</a></span></li>
                        </ul>
                    </div>
                    <div class="nav">
                        <h3>快速通道</h3>
                        <ul class="nav-1">
                            <li><a href="/pfbet/" target="_blank">购彩记录</a></li>
                            <li><a href="/pftrace/" target="_blank">追号记录</a></li>
                            <li><a href="/projlist/autobuylist/" target="_blank">跟单记录</a></li>
                        </ul>
                        <ul class="nav-2">
                            <li><a class="lnk" href="/pfxiaofei/" target="_blank"><i class="ico ico-account"></i>账户明细</a></li>
                            <li><a class="lnk" href="/pfzhiliao/mpp/" target="_blank"><i class="ico ico-pwd"></i>修改密码</a></li>
                            <li><a class="lnk" href="/pfzhiliao/" target="_blank"><i class="ico ico-user2"></i>个人资料</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
<div class="home-nav-warpper">
	<div class="home-nav clearfix">
		      <span class="menu nav-cz" id="pub_top_lottery_list">
      	  <b>选择彩种</b>
	      <div class="nav-cz-cont lottery-all-list">
				<div class="nav-cz-list lottery-map-item">
		        <a class="muted nav-cz-icon"  href="http://cp.360.cn/jczq/?src=topmenu" target="_blank"><img src="http://p4.qhimg.com/t0146da685972bb025e.png">竞技</a>
		        <p class="cz-title-list"><a target="_blank"  href="http://cp.360.cn/jczq/?src=topmenu">竞彩足球<img src="" class="none" /></a><a  href="http://cp.360.cn/jclq/?src=topmenu" target="_blank">竞彩篮球<img src="" class="none" /></a><a  href="http://cp.360.cn/dc/?src=topmenu" target="_blank">北京单场</a><a  href="http://cp.360.cn/dcsf/?src=topmenu" target="_blank">胜负过关</a><a  href="http://cp.360.cn/sfc/?src=topmenu" target="_blank">胜负彩</a><a  href="http://cp.360.cn/rj/?src=topmenu" target="_blank">任选九</a><a  href="http://cp.360.cn/zc6/?src=topmenu" target="_blank">半全场</a><a  href="http://cp.360.cn/jq4/?src=topmenu" target="_blank">进球彩</a></p>
	        </div>
	        <div class="nav-cz-list lottery-map-item">
		        <a class="muted nav-cz-icon"  href="http://cp.360.cn/yun11/?src=topmenu" target="_blank"><img src="http://p9.qhimg.com/t0102cfce41f59e5307.png">高频</a>
		        <p class="cz-title-list"><a  href="http://cp.360.cn/yun11/?src=topmenu" target="_blank">11选5</a><a  href="http://cp.360.cn/sh11/?src=topmenu" target="_blank">上海11选5</a><a  href="http://cp.360.cn/gd11/?src=topmenu" target="_blank">粤11选5</a><a  href="http://cp.360.cn/xj11/?src=topmenu" target="_blank">新疆11选5</a><a  href="http://cp.360.cn/ln11/?src=topmenu" target="_blank">辽宁11选5</a><a  href="http://cp.360.cn/dlcjx/?src=topmenu" target="_blank">新11选5</a><a  href="http://cp.360.cn/hlj11/?src=topmenu" target="_blank">幸运11选5</a><a  href="http://cp.360.cn/pk3/?src=topmenu" target="_blank">快乐扑克</a><a  href="http://cp.360.cn/ssccq/?src=topmenu" target="_blank">老时时彩</a><a  href="http://cp.360.cn/k3gx/?src=topmenu" target="_blank">好运快3</a><a  href="http://cp.360.cn/k3js/?src=topmenu" target="_blank">老快3</a><a  href="http://cp.360.cn/k3hb/?src=topmenu" target="_blank">湖北快3</a><a  href="http://cp.360.cn/k3jl/?src=topmenu" target="_blank">新快3</a><a  href="http://cp.360.cn/k3nm/?src=topmenu" target="_blank">快3</a><a  href="http://cp.360.cn/kl8/?src=topmenu" target="_blank">快乐8</a></p>
	        </div>
	        <div class="nav-cz-list lottery-map-item">
		        <a class="muted nav-cz-icon"  href="http://cp.360.cn/ssq/?src=topmenu" target="_blank"><img src="http://p6.qhimg.com/t01398ced4dc708f04c.png">数字</a>
		        <p class="cz-title-list"><a  href="http://cp.360.cn/ssq/?src=topmenu" target="_blank">双色球</a><a  href="http://cp.360.cn/slt/?src=topmenu" target="_blank">大乐透</a><a  href="http://cp.360.cn/sd/?src=topmenu" target="_blank">福彩3D</a><a  href="http://cp.360.cn/p3/?topmenu" target="_blank">排列三</a><a  href="http://cp.360.cn/qlc/?topmenu" target="_blank">七乐彩</a><a  href="http://cp.360.cn/p5/?topmenu" target="_blank">排列五</a><a  href="http://cp.360.cn/qxc/?topmenu" target="_blank">七星彩</a><a  href="http://cp.360.cn/xw/?topmenu" target="_blank">15选5</a></p>
	        </div>	      </div>
      </span>  
       <ul id="pub_top_nav_list_menu">
	      <li class=" wd"><a href="/?nav" target="_self">首页</a></li>
	      <li class=" wd"><a href="/coophall/?src=topmenu" target="_self">合买</a>
		      <div class="child-nav none">
				  <a href="/autobuy/?src=topmenu" target="_blank">跟单</a>
			  </div>
	      </li>
	      <li class=" wd"><a href="/kj/kaijiang.html?src=topmenu" target="_self">开奖</a>
	      	 <div class="child-nav none">
		          <a href="/exphall/?src=topmenu" target="_blank">过关</a>
				  <a href="/topprize/?src=topmenu" target="_blank">大奖</a>
			  </div>
	      </li>
	      <li class=""><a href="/charthome/?src=topmenu" target="_blank">走势图</a></li>
	       <li><a href="/zx/index" target="_self">彩票资讯</a></li>
	      <li><a href="http://odds.cp.360.cn/livex/jczq?src=djph" target="_blank">比分直播</a>
	      	<div class="child-nav none">
		          <a href="http://odds.cp.360.cn/livex?src=djph" target="_blank">比分直播</a>
				  <a href="http://odds.cp.360.cn/liansai?src=djph" target="_blank">联赛资料</a>
				  <a href="http://odds.cp.360.cn/index?src=djph" target="_blank">指数中心</a>
			  </div>
	      </li>
	      <li class=""><a href="/ssq/bonus/?src=topmenu" target="_blank">奖金计算</a>
	      	<div class="child-nav none">
		          <a href="/ssq/forcast/?src=topmenu" target="_blank">媒体预测</a>
				  <a href="/tools/ssqCompare" target="_blank">开奖对比</a>
				  <a href="/tools/xbeitou?src=topmenu" target="_blank">倍投计算</a>
				  <!-- <a href="/zczs/?src=topmenu" target="_blank">足彩助手</a> -->
			  </div>
	      </li>
           <li class=""><a href="/hongbao/?src=topmenu" target="_blank">优惠红包</a>
               <div class="child-nav none">
                   <a href="/person/homepage?src=topmenu" target="_blank">活动中心</a>
                   <a href="/jifen/?src=topmenu" target="_blank">积分商城</a>
               </div>
           </li>
           <!--li class=""><a href="http://leitai.cp.360.cn/fifa?src=topmenu" target="_blank">有奖擂台</a>
           </li-->
	      <li class="wd"><a href="http://bbs.360.cn/forum.php?gid=239&src=home" target="_blank">论坛</a></li>
	      <li class="home-nav-telephone"><a href="/mobile/?src=topmenu" target="_blank">手机购彩</a>
	      	 <div class="home-app-ewm none">
			      <h3>离梦想最近的地方</h3>
			      <p>扫一扫，包你100%中奖</p>
			      <a href="http://cp.360.cn/mobile/?src=topmenu" target="_blank"><img width="134" height="134" src="http://p0.qhimg.com/t01d7654b5b70a0f496.png" alt="二维码"></a>
			      <input class="home-app-value" type="text" id="top_mobile_qc" maxlength="13" autocomplete="off" placeholder="输入手机号获取地址"><input class="app-dispatch" id="top_mobile_qc_btn" type="button" value="发送">
			      <p class="home-app-point"  id="top_mobile_qc_err" data-text="访问手机触屏版：m.cp.360.cn">访问手机触屏版：m.cp.360.cn</p>
		     </div>
	      </li>
	  </ul>
    </div>
</div>
        <div class="panle-aside-lucky" style="top:30%;width:210px;">
    <div class="panle-aside-box" style="width:210px;">
        <div class="panle-aside-cont" style="width:210px;">
            <span class="panle-aside-close">×</span>
            <div class="panle-aside-bd" style="height:350px;">
                <a href="https://mkt.360jie.com.cn/activity/guide/kanedupc?utm_source=360caipiao&utm_medium=banner&utm_campaign=10yuanhb_201705" target="_blank"> <img height="350" width="210" src="https://p0.ssl.qhimg.com/t0133f50cfdd8ab730b.png" ></a>
            </div>
           
        </div>
    </div>
</div>    <div id="wrap">
        
        <div class="ad980 none"><a href="http://zqb.360.cn/pcact/hotgame" target="_blank"><img src="http://p7.qhimg.com/t01e1abec5721ec1819.png" alt="" /></a></div>        <!-- main area -->
        <div class="c-bd">
            <div class="grid-2">
                <div class="article">
                    <div class="kaij-news-table" style="position:relative">
                       <a style="display:none;position:absolute; top:39px;left:856px;height:22px;" href="http://huodong.cp.360.cn/freejc" target="_blank"><img src="http://p2.qhimg.com/t0156d634e658ccb00d.png" ></a>
                          <a style="display:none;position:absolute; top:109px;left:856px;height:22px;" href="http://huodong.cp.360.cn/freejc/slt" target="_blank"><img src="http://p2.qhimg.com/t0156d634e658ccb00d.png" ></a> 
                        <table width="100%">
                            <thead>
                                <tr>
                                    <th class="t1">彩种描述</th>
                                    <th class="t1">开奖详情</th>
                                    <th class="t1">实用工具</th>
                                    <th>购买彩票</th>
                                </tr>
                            </thead>
                            <tbody>
                                                                <tr class=\'even\'><td><div class=\'description\'><div class=\'kaijmsg\'>今日开奖</div><h3><a target=\'_blank\' href=\'/ssq/?a=qgkj\' class=\'cz-name\'>双色球</a><span class=\'date\'>第 2017080 期</span></h3><p><span class=\'data\'>每周二、四、日 <b class=\'red\'>21:20</b>开奖</span></p></td><td ><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll\'><b>01</b></em><em class=\'kaij-btn-boll\'><b>12</b></em><em class=\'kaij-btn-boll\'><b>16</b></em><em class=\'kaij-btn-boll\'><b>20</b></em><em class=\'kaij-btn-boll\'><b>22</b></em><em class=\'kaij-btn-boll\'><b>24</b></em><em class=\'kaij-btn-boll kaij-btn-boll-blue\'><b>08</b></em></span><span><a target=\'_blank\' href=\'/kj/ssq.html\' class=\'lnk detail\'>详情</a></span></div><p ><span class=\'data\'>07-11 (周二) &nbsp;&nbsp;&nbsp;一等奖：<em class=\'red\'>642</em>万 奖池：<b class=\'red\'>7.61</b>亿 </span></p></div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://chart.cp.360.cn/kaijiang/ssq?a=qgkj\'>历史开奖</a> <a target=\'_blank\' href=\'http://chart.cp.360.cn/zst/ssq?a=qgkj\'>走势图表</a> <a target=\'_blank\' href=\'/shdd/ssq?a=qgkj\'>杀号定胆</a> <a target=\'_blank\' href=\'/prize/ssq?a=qgkj\'>大奖排行</a><a target=\'_blank\' href=\'/ssq/bonus?a=qgkj\'>奖金计算</a></p></div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/ssq/?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/ssq/?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr><td><div class=\'description\'><h3><a target=\'_blank\' href=\'/slt/?a=qgkj\' class=\'cz-name\'>大乐透</a><span class=\'date\'>第 2017080 期</span></h3><p><span class=\'data\'>每周一、三、六 <b class=\'red\'>20:30</b>开奖</span></p></td><td ><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll\'><b>08</b></em><em class=\'kaij-btn-boll\'><b>10</b></em><em class=\'kaij-btn-boll\'><b>21</b></em><em class=\'kaij-btn-boll\'><b>30</b></em><em class=\'kaij-btn-boll\'><b>31</b></em><em class=\'kaij-btn-boll kaij-btn-boll-blue\'><b>02</b></em><em class=\'kaij-btn-boll kaij-btn-boll-blue\'><b>05</b></em></span><span><a target=\'_blank\' href=\'/kj/slt.html\' class=\'lnk detail\'>详情</a></span></div><p ><span class=\'data\'>07-12 (周三) &nbsp;&nbsp;&nbsp;一等奖：<em class=\'red\'>989</em>万 奖池：<b class=\'red\'>38.63</b>亿 </span></p></div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://chart.cp.360.cn/kaijiang/slt?a=qgkj\'>历史开奖</a> <a target=\'_blank\' href=\'http://chart.cp.360.cn/zst/slt?a=qgkj\'>走势图表</a> <a target=\'_blank\' href=\'/shdd/slt?a=qgkj\'>杀号定胆</a> <a target=\'_blank\' href=\'/prize/slt?a=qgkj\'>大奖排行</a><a target=\'_blank\' href=\'/slt/bonusstd?a=qgkj\'>奖金计算</a></p></div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/slt/?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/slt/?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr class=\'even\'><td><div class=\'description\'><h3><a target=\'_blank\' href=\'/qlc/?a=qgkj\' class=\'cz-name\'>七乐彩</a><span class=\'date\'>第 2017080 期</span></h3><p><span class=\'data\'>每周一、三、五 <b class=\'red\'>21:20</b>开奖</span></p></td><td ><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll\'><b>02</b></em><em class=\'kaij-btn-boll\'><b>04</b></em><em class=\'kaij-btn-boll\'><b>09</b></em><em class=\'kaij-btn-boll\'><b>14</b></em><em class=\'kaij-btn-boll\'><b>16</b></em><em class=\'kaij-btn-boll\'><b>21</b></em><em class=\'kaij-btn-boll\'><b>27</b></em><em class=\'kaij-btn-boll kaij-btn-boll-blue\'><b>18</b></em></span><span><a target=\'_blank\' href=\'/kj/qlc.html\' class=\'lnk detail\'>详情</a></span></div><p ><span class=\'data\'>07-12 (周三) &nbsp;&nbsp;&nbsp;一等奖：<em class=\'red\'>62</em>万</div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://chart.cp.360.cn/kaijiang/qlc?a=qgkj\'>历史开奖</a> <a target=\'_blank\' href=\'http://chart.cp.360.cn/zst/qlc?a=qgkj\'>走势图表</a> <a target=\'_blank\' href=\'/shdd/qlc?a=qgkj\'>杀号定胆</a> <a target=\'_blank\' href=\'/prize/qlc?a=qgkj\'>大奖排行</a><a target=\'_blank\' href=\'/qlc/bonus?a=qgkj\'>奖金计算</a></p></div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/qlc/?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/qlc?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr><td><div class=\'description\'><h3><a target=\'_blank\' href=\'/qxc/?a=qgkj\' class=\'cz-name\'>七星彩</a><span class=\'date\'>第 2017080 期</span></h3><p><span class=\'data\'>每周二、五、日 <b class=\'red\'>20:30</b>开奖</span></p></td><td ><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll\'><b>4</b></em><em class=\'kaij-btn-boll\'><b>3</b></em><em class=\'kaij-btn-boll\'><b>8</b></em><em class=\'kaij-btn-boll\'><b>9</b></em><em class=\'kaij-btn-boll\'><b>2</b></em><em class=\'kaij-btn-boll\'><b>4</b></em><em class=\'kaij-btn-boll\'><b>4</b></em></span><span><a target=\'_blank\' href=\'/kj/qxc.html\' class=\'lnk detail\'>详情</a></span></div><p ><span class=\'data\'>07-11 (周二) &nbsp;&nbsp;&nbsp;一等奖：未开出 奖池：<b class=\'red\'>1055</b>万 </span></p></div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://chart.cp.360.cn/kaijiang/qxc?a=qgkj\'>历史开奖</a> <a target=\'_blank\' href=\'http://chart.cp.360.cn/zst/qxc?a=qgkj\'>走势图表</a> <a target=\'_blank\' href=\'/shdd/qxc?a=qgkj\'>杀号定胆</a> <a target=\'_blank\' href=\'/prize/qxc?a=qgkj\'>大奖排行</a></div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/qxc/?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/qxc/?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr class=\'even\'><td><div class=\'description\'><div class=\'kaijmsg\'>今日开奖</div><h3><a target=\'_blank\' href=\'/sdx/?a=qgkj\' class=\'cz-name\'>福彩3D</a><span class=\'date\'>第 2017186 期</span></h3><p><span class=\'data\'>每天 <b class=\'red\'>21:15</b>开奖</span></p></td><td ><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll\'><b>0</b></em><em class=\'kaij-btn-boll\'><b>3</b></em><em class=\'kaij-btn-boll\'><b>3</b></em><em>(组三)</em><em>&nbsp;</em><em>试机号：<b>6&nbsp;9&nbsp;6&nbsp;</b></em></span><span><a target=\'_blank\' href=\'/kj/sd.html\' class=\'lnk detail\'>详情</a></span></div><p ><span class=\'data\'>07-12 (周三) &nbsp;&nbsp;&nbsp;直选：<em class=\'red\'>1040</em>元 组三：<em class=\'red\'>346</em>元</div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://chart.cp.360.cn/kaijiang/sd?a=qgkj\'>历史开奖</a> <a target=\'_blank\' href=\'http://chart.cp.360.cn/zst/sd?a=qgkj\'>走势图表</a> <a target=\'_blank\' href=\'/shdd/sd?a=qgkj\'>杀号定胆</a> <a target=\'_blank\' href=\'/prize/sd?a=qgkj\'>大奖排行</a></div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/sdx/?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/sd/?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr><td><div class=\'description\'><div class=\'kaijmsg\'>今日开奖</div><h3><a target=\'_blank\' href=\'/p3/?a=qgkj\' class=\'cz-name\'>排列三</a><span class=\'date\'>第 2017186 期</span></h3><p><span class=\'data\'>每天 <b class=\'red\'>20:30</b>开奖</span></p></td><td ><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll\'><b>9</b></em><em class=\'kaij-btn-boll\'><b>6</b></em><em class=\'kaij-btn-boll\'><b>7</b></em><em>(组六)</em></span><span><a target=\'_blank\' href=\'/kj/p3.html\' class=\'lnk detail\'>详情</a></span></div><p ><span class=\'data\'>07-12 (周三) &nbsp;&nbsp;&nbsp;直选：<em class=\'red\'>1040</em>元 组六：<em class=\'red\'>173</em>元</div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://chart.cp.360.cn/kaijiang/p3?a=qgkj\'>历史开奖</a> <a target=\'_blank\' href=\'http://chart.cp.360.cn/zst/p3?a=qgkj\'>走势图表</a> <a target=\'_blank\' href=\'/shdd/p3?a=qgkj\'>杀号定胆</a> <a target=\'_blank\' href=\'/prize/p3?a=qgkj\'>大奖排行</a></div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/p3/?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/p3?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr class=\'even\'><td><div class=\'description\'><div class=\'kaijmsg\'>今日开奖</div><h3><a target=\'_blank\' href=\'/p5/?a=qgkj\' class=\'cz-name\'>排列五</a><span class=\'date\'>第 2017186 期</span></h3><p><span class=\'data\'>每天 <b class=\'red\'>20:30</b>开奖</span></p></td><td ><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll\'><b>9</b></em><em class=\'kaij-btn-boll\'><b>6</b></em><em class=\'kaij-btn-boll\'><b>7</b></em><em class=\'kaij-btn-boll\'><b>8</b></em><em class=\'kaij-btn-boll\'><b>8</b></em></span><span><a target=\'_blank\' href=\'/kj/p5.html\' class=\'lnk detail\'>详情</a></span></div><p ><span class=\'data\'>07-12 (周三) &nbsp;&nbsp;&nbsp;一等奖：<em class=\'red\'>10</em>万</div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://chart.cp.360.cn/kaijiang/p5?a=qgkj\'>历史开奖</a> <a target=\'_blank\' href=\'http://chart.cp.360.cn/zst/p5?a=qgkj\'>走势图表</a> <a target=\'_blank\' href=\'/shdd/p5?a=qgkj\'>杀号定胆</a> <a target=\'_blank\' href=\'/prize/p5?a=qgkj\'>大奖排行</a></div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/p5/?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/p5/?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr><td><div class=\'description\'><div class=\'kaijmsg\'>今日开奖</div><h3><a target=\'_blank\' href=\'/xw/?a=qgkj\' class=\'cz-name\'>15选5</a><span class=\'date\'>第 2017186 期</span></h3><p><span class=\'data\'>每天 <b class=\'red\'>19:10</b>开奖</span></p></td><td ><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll\'><b>04</b></em><em class=\'kaij-btn-boll\'><b>05</b></em><em class=\'kaij-btn-boll\'><b>09</b></em><em class=\'kaij-btn-boll\'><b>10</b></em><em class=\'kaij-btn-boll\'><b>11</b></em></span><span><a target=\'_blank\' href=\'/kj/xw.html\' class=\'lnk detail\'>详情</a></span></div><p ><span class=\'data\'>07-12 (周三) &nbsp;&nbsp;&nbsp;一等奖：<em class=\'red\'>1819</em>元 奖池：<b class=\'red\'>67</b>万 </span></p></div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://chart.cp.360.cn/kaijiang/xw?a=qgkj\'>历史开奖</a> <a target=\'_blank\' href=\'http://chart.cp.360.cn/zst/xw?a=qgkj\'>走势图表</a> <a target=\'_blank\' href=\'/shdd/xw?a=qgkj\'>杀号定胆</a> <a target=\'_blank\' href=\'/prize/xw?a=qgkj\'>大奖排行</a><a target=\'_blank\' href=\'/xw/bonus?a=qgkj\'>奖金计算</a></p></div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/xw/?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/xw/?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr class=\'even\' id=\'sfc\'><td><div class=\'description\'><h3><a target=\'_blank\' href=\'/sfc?a=qgkj\' class=\'cz-name\'>胜负彩</a><span class=\'date\'>第 2017095 期</span></h3><p><span class=\'data\'>不定期开奖，最高奖金500万</span></p></td><td><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em></span><span><a target=\'_blank\' href=\'/sfc?a=qgkj\' class=\'lnk detail\'>详情</a></span></div><p><span class=\'data\'>07-11 (周二) &nbsp;&nbsp;&nbsp;一等奖：<em class=\'red\'>15</em>万 滚存：<em class=\'red\'>0</em>元 </span></p></div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://odds.cp.360.cn/live/zc?a=qgkj\'>比分直播</a> <a target=\'_blank\' href=\'/exphall/sfc?a=qgkj\'>过关统计</a></p> </div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/sfc?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/sfc/?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr id=\'rj\'><td><div class=\'description\'><h3><a target=\'_blank\' href=\'/rj?a=qgkj\' class=\'cz-name\'>任选九</a><span class=\'date\'>第 2017095 期</span></h3><p><span class=\'data\'>不定期开奖，最高奖金500万</span></p></td><td><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em></span><span><a target=\'_blank\' href=\'/rj?a=qgkj\' class=\'lnk detail\'>详情</a></span></div><p><span class=\'data\'>07-11 (周二) &nbsp;&nbsp;&nbsp;一等奖：<em class=\'red\'>623</em>元 </span></p></div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://odds.cp.360.cn/live/zc?a=qgkj\'>比分直播</a> <a target=\'_blank\' href=\'/exphall/rj?a=qgkj\'>过关统计</a></p> </div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/rj?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/rj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr class=\'even\' id=\'jq4\'><td><div class=\'description\'><h3><a target=\'_blank\' href=\'/jq4?a=qgkj\' class=\'cz-name\'>4场进球彩</a><span class=\'date\'>第 2017095 期</span></h3><p><span class=\'data\'>不定期开奖，最高奖金500万</span></p></td><td><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em></span><span><a target=\'_blank\' href=\'/jq4?a=qgkj\' class=\'lnk detail\'>详情</a></span></div><p><span class=\'data\'>07-11 (周二) &nbsp;&nbsp;&nbsp;一等奖：<em class=\'red\'>1</em>万 滚存：<em class=\'red\'>0</em>元 </span></p></div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://odds.cp.360.cn/livex/jq4?q=qgkj\'>比分直播</a> <a target=\'_blank\' href=\'/exphall/jq4?a=qgkj\'>过关统计</a></p> </div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/jq4?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/jq4\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr id=\'zc6\'><td><div class=\'description\'><h3><a target=\'_blank\' href=\'/zc6?a=qgkj\' class=\'cz-name\'>6场半全场</a><span class=\'date\'>第 2017095 期</span></h3><p><span class=\'data\'>不定期开奖，最高奖金500万</span></p></td><td><div class=\'detailed\'><div class=\'kaij-data\'><span class=\'kaij-data-list\'><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>3</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>0</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em><em class=\'kaij-btn-boll2\'><b>1</b></em></span><span><a target=\'_blank\' href=\'/zc6?a=qgkj\' class=\'lnk detail\'>详情</a></span></div><p><span class=\'data\'>07-11 (周二) &nbsp;&nbsp;&nbsp;一等奖：<em class=\'red\'>2</em>万 滚存：<em class=\'red\'>0</em>元 </span></p></div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://odds.cp.360.cn/livex/zc6?a=qgkj\'>比分直播</a> <a target=\'_blank\' href=\'/exphall/zc6?a=qgkj\'>过关统计</a></p> </div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/zc6?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/zc6\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr class=\'even\' id=\'jczq\'><td><div class=\'description\'><h3><a target=\'_blank\' href=\'/jczq/?a=qgkj\' class=\'cz-name\'>竞彩足球</a><span class=\'date\'></span></h3><p><span class=\'data\'>猜足球比赛，天天赢大奖</span></p></td><td><div class=\'detailed\'><div class=\'kaij-data\'><span class="desc">金杯赛：哥斯达黎加<b class="red">1:1</b>加拿大<span><span><a target=\'_blank\' href=\'http://odds.cp.360.cn/kjnotice/jczq/?a=qgkj\' class=\'lnk detail\'>更多</a></span></div><p><span class=\'data\'>当前有<em class=\'red\'>27</em>场比赛可投注 / 已结束36场 </span></p></div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://odds.cp.360.cn/kjnotice/jczq/?a=qgkj\'>历史开奖</a> <a target=\'_blank\' href=\'http://odds.cp.360.cn/live/jczq?a=qgkj\'>比分直播</a> <a target=\'_blank\' href=\'/prize/jczq?a=qgkj\'>大奖排行</a> <a target=\'_blank\' href=\'/exphall/jczq?a=qgkj\'>过关统计</a></p> </div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/jczq/?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/jczq/?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr id=\'dc\'><td><div class=\'description\'><h3><a target=\'_blank\' href=\'/dc/?a=qgkj\' class=\'cz-name\'>北京单场</a><span class=\'date\'></span></h3><p><span class=\'data\'>猜足球比赛，猜中一场也有奖</span></p></td><td><div class=\'detailed\'><div class=\'kaij-data\'><span class="desc">欧冠：里耶卡<b class="red">2:0</b>新圣徒</span><span><a target=\'_blank\' href=\'http://odds.cp.360.cn/kjnotice/bjdc/?a=qgkj\' class=\'lnk detail\'>更多</a></span></div><p><span class=\'data\'>当前有<em class=\'red\'>56</em>场比赛可投注 / 已结束67场 </span></p></div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://odds.cp.360.cn/kjnotice/bjdc/?a=qgkj\'>历史开奖</a> <a target=\'_blank\' href=\'http://odds.cp.360.cn/live/bjdc?a=qgkj\'>比分直播</a> <a target=\'_blank\' href=\'/prize/dc?a=qgkj\'>大奖排行</a> <a target=\'_blank\' href=\'/exphall/dc?a=qgkj\'>过关统计</a></p> </div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/dc/?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/dc/?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>
<tr class=\'even\' id=\'jclq\'><td><div class=\'description\'><h3><a target=\'_blank\' href=\'/jclq/?a=qgkj\' class=\'cz-name\'>竞彩篮球</a><span class=\'date\'></span></h3><p><span class=\'data\'>猜篮球比赛，返奖率69%</span></p></td><td><div class=\'detailed\'><div class=\'kaij-data\'><span class="desc">WNBA：自由<b class="red">69:81</b>水星</span><span><a target=\'_blank\' href=\'http://odds.cp.360.cn/kjnotice/jclq/?a=qgkj\' class=\'lnk detail\'>更多</a></span></div><p><span class=\'data\'>当前有<em class=\'red\'>2</em>场比赛可投注 / 已结束3场 </span></p></div></td><td><div class=\'tools\'><p> <a target=\'_blank\' href=\'http://odds.cp.360.cn/kjnotice/jclq/?a=qgkj\'>历史开奖</a> <a target=\'_blank\' href=\'http://odds.cp.360.cn/live/jclq?a=qgkj\'>比分直播</a> <a target=\'_blank\' href=\'/prize/jclq?a=qgkj\'>大奖排行</a> <a target=\'_blank\' href=\'/exphall/jclq?a=qgkj\'>过关统计</a></p> </div></td><td><div class=\'kaij-button\'><a target=\'_blank\' href=\'/jclq/?a=qgkj\' class=\'btn-min buy-btn\'>购买</a><a target=\'_blank\' href=\'/hm/jclq/?a=qgkj\' class=\'btn-min hebuy-btn\'>合买</a></div></td></tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="kaij-news-tisps"><p>开奖提醒：数据来源由彩票中心官方网站提供，仅供参考。</p></div>
                </div>
            </div>
        </div>
        <!--<div class="mobile-code">
	<div style="position:relative;">
		<a href="javascript:void(0)" class="qrcode"> <i class="ico ico-mobile"></i> 手机随时购彩优惠多多<br/> <i class="ico ico-right"></i> </a>
		<div class="qrcode-box-wrap">
			<span class="qrcode-box">
				<p>
					扫一扫下载手机客户端
				</p>
                <a href="http://huodong.cp.360.cn/newuser/?gcdtsm" target="_blank"><img src="http://p9.qhimg.com/t019c17076d67fd0cff.png" alt="" width="90px" height="90px"></a>
				<p>
					<b>购彩包你中奖</b>
				</p>
				<p>
					<a href="http://huodong.cp.360.cn/newuser/?gcdtsm" target="_blank" class="appdown" style="font-size:13px;padding:0 5px">免费拿苹果6</a>
				</p></span>
		</div>
	</div>
</div><script type="text/javascript">
	//手机下载浮窗
	(function mobile_code() {
		try {
			window.$(window).on(\'resize\', function() {
				if ($(window).width() < 1380) {
					$(\'.qrcode\').find(\'i:eq(1)\').removeClass(\'ico-right\').addClass(\'ico-left\');
					$(\'.qrcode-box\').css({marginLeft:\'150px\'});
					$(\'.mobile-code\').unbind().hover(function() {
							$(\'.qrcode-box-wrap\').css({width:\'150px\',marginLeft:\'-189px\'}).show();
							$(this).find(\'i:eq(1)\').removeClass(\'ico-left\').addClass(\'ico-right\');
							$(\'.qrcode-box\').stop(true).animate({
								marginLeft : \'0px\'
							}, 400);
						}, function() {
							$(this).find(\'i:eq(1)\').removeClass(\'ico-right\').addClass(\'ico-left\');
							$(\'.qrcode-box\').animate({
								marginLeft : \'150px\'
							}, 400, function(){$(\'.qrcode-box-wrap\').hide();});
						});
				} else {
					$(\'.qrcode\').find(\'i:eq(1)\').removeClass(\'ico-left\').addClass(\'ico-right\');
					$(\'.qrcode-box\').css({marginLeft:\'-160px\'});
					$(\'.mobile-code\').unbind().hover(function() {
							$(\'.qrcode-box-wrap\').css({width:\'160px\',marginLeft:\'0px\'}).show();
							$(this).find(\'i:eq(1)\').removeClass(\'ico-right\').addClass(\'ico-left\');
							$(\'.qrcode-box\').stop(true).animate({
								marginLeft : \'0\'
							}, 400);
						}, function() {
							$(this).find(\'i:eq(1)\').removeClass(\'ico-left\').addClass(\'ico-right\');
							$(\'.qrcode-box\').animate({
								marginLeft : \'-151px\'
							}, 400,function(){$(\'.qrcode-box-wrap\').hide();});
						});
				}
			});
			//初始化css
			$(\'.qrcode-box-wrap\').css({position:\'relative\',zIndex: 999});
			$(\'.qrcode\').css({position:\'relative\',zIndex: 1000});
			$(\'.qrcode-box\').css({width:120,borderLeft:\'1px solid #ccc\'});
			$(window).trigger(\'resize\');
			$(\'.mobile-code\').trigger(\'mouseenter\');
			setTimeout(function(){$(\'.mobile-code\').trigger(\'mouseleave\'); } , 4000); 
		} catch(e) {
			setTimeout(mobile_code, 500);
		}
	})()
</script>-->
        <div class="ad980" style="display:none"><a href="#"><img src="http://p6.qhimg.com/t01de26dbcd54b3511b.png" alt="" /></a></div>    <div class="footer" id="ft">
	<p>
	<a href="http://bbs.360safe.com/thread-256540-1-1.html" target="_blank">关于360彩票</a>
	<a href="http://www.360.cn/about/zhaopin.html" target="_blank">招聘信息</a>
	<a href="http://bbs.360safe.com/thread-256555-1-1.html" target="_blank">联系我们</a>
	<a href="http://bbs.360safe.com/forum-253-1.html" target="_blank">投诉建议</a>
	<a href="http://www.360.cn/custom/bdhezuo.html" target="_blank">合作伙伴</a>
	<a href="/activity/feedback/" target="_blank">意见反馈</a>
	</p>
	<span class="policy">
	<a class="o1" href="http://www.bj.cyberpolice.cn/index.jsp" target="_blank"></a>
	<!-- <a class="o2" href="http://www.360.cn/award3.html" target="_blank"></a> -->
	<!-- <a class="o3" href="http://www.360.cn/award1.html" target="_blank"></a> -->
	<a class="o4" href="http://www.bjjubao.org/" target="_blank"></a>
	<a class="o5" href="https://www.privacyassociation.org/" target="_blank"></a>
	</span>
	<!--
		<p>
		<em>Copyright&copy;2005-2017 360.cn版权所有</em>
		<a href="http://www.miibeian.gov.cn/" target="_blank">京ICP证080047号[原京ICP备06060858号]</a>
		<em>京公网安备110000000006号</em>
		<a href="http://www.360.cn/gongshangyingyezhizhao.html" target="_blank">工商营业执照</a>
		</p>
	-->
	
	<div id="copyright" style="padding:20px 0;text-align:center;line-height:2;color: #999;">
        <p>Copyright&copy;2005-2017 360.cn版权所有 360互联网安全中心</p>
        <p><a style="color:#999;" href="http://www.miitbeian.gov.cn/">京ICP证080047号[京ICP备08010314号-6]</a><a style="color:#999;" href="http://www.360.cn/licence1.html"> 文网文[2009]024号</a><a style="color:#999;" href="http://www.360.cn/licence2.html"> 新出网证（京）字069号</a> <a style="color:#999;" href="http://www.360.cn/gongshangyingyezhizhao.html">工商营业执照</a></p><p></p><p><a style="color:#999;" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11000002000006"><img src="http://p4.qhimg.com/t01d8eda6e551cf2615.png" style="vertical-align:middle;" />京公网安备 11000002000006号</a></p>
    </div>
	
	<p>
	<!--em>客服电话：010-59059560</em-->
	<em>客服邮箱：caipiao@360.cn</em>
	<em>投诉建议邮箱：caipiao@360.cn</em>
	</p>
	<p class="red">360彩票郑重提示：彩票有风险，投注需谨慎！禁止向未满18周岁的青少年出售彩票！</p>
	<!--[if lte IE 8]>
    <p id="oldietips">想要购彩更快更安全，请<a style="color:#146AC9" norandom="true" target="_blank" href="http://down.360safe.com/se/360se6_6.3.1.134.exe">下载360安全浏览器最新版</a>或<a style="color:#146AC9" target="_blank" norandom="true" href="http://down.360safe.com/cse/360cse_7.0.0.560.exe">下载360极速浏览器</a></p>
    <p style="color:#666">如果您已使用360安全浏览器超速版等双核浏览器，请切换到极速模式</p>
    <script>if(navigator.userAgent.indexOf(\'360se\')>-1){$(\'#oldidtips\').hide();}</script>
    <![endif]-->
</div><!--end  footer-->
    </div>
    <script src="http://s5.cp.360.cn/trade/2013/static/v1/js/src/lib/jquery-1.10.2.min.js"></script>
<script src="http://s6.cp.360.cn/trade/2013/static/v1/js/src/lib/underscore-min.js"></script>
<script src="http://s6.cp.360.cn/trade/merge/BNzyAvI3euey.js?v1.0.99.js"></script>
<script src="http://s5.cp.360.cn/trade/2013/static/v1/js/src/plugs/q.ui.marquee.js?v1.0.99.js"></script>
<script src="http://s6.cp.360.cn/trade/2013/static/v1/js/lottery/kaijiang/kaij-news.js?v1.0.99.js"></script>
<script src="http://s5.cp.360.cn/trade/2013/static/v1/js/include/wings.js?v1.0.99.js"></script>
    <div id="cssHasLoadFlag110" style="height:0;width:0;"></div>
<script type="text/javascript">
    (function() {\'use strick\'
        //复查时需检测的域列表
        var domainList = [\'http://s0.cp.360.cn/trade\',\'http://s5.cp.360.cn/trade\',\'http://s6.cp.360.cn/trade\'];
        //检测的文件路径及名称
        var filePath = \'/check.dns.js\';
        //获取标签的非行间样式
        var getStyle = function(obj, attr) {
            if ( typeof obj == \'object\') {
                if (obj.currentStyle) {
                    return obj.currentStyle[attr];
                } else {
                    return getComputedStyle(obj, false)[attr];
                };
            }
        };
        //未成功加载复查 ，对于不支持 onerror事件直接打点
        var recheck = function(url, failCallback) {
            if (\'onerror\' in document) {
                var head = document.getElementsByTagName(\'head\')[0] || document.documentElement, script = document.createElement(\'script\');
                script.onerror = function() {
                    failCallback(url);
                    script.onerror = null;
                    head.removeChild(script);
                };
                script.src = url;
                head.insertBefore(script, head.firstChild);
            } else {
                failCallback(url);
            }
        };
        var isOk = getStyle(document.getElementById(\'cssHasLoadFlag110\'), \'display\') == \'none\' && window.Q;
        if (!isOk) {
            for (var i = 0, l = domainList.length; i < l; i++) {
                recheck(domainList[i] + filePath, function(url) {
                    var img = new Image();
                    img.src = \'http://cp.360.cn/debug/debugcdn?src=dns_\' + encodeURIComponent(url);
                });
            }
        }
    })()
</script><script>
    //flag为true时为live800主用帐号,false时为备用帐号
    $(function() {
        var enterUrl = \'\';
        try {
            enterUrl = window.top.location.href;
        } catch(err) {
        }
        enterUrl = enterUrl || window.location.href;
        var flag = false;
       // var url = flag ? "http://v1.live800.com/live800/chatClient/chatbox.jsp?companyID=147557&configID=40801&jid=6145526885&enterurl=" + enterUrl : "http://chat56.live800.com/live800/chatClient/chatbox.jsp?companyID=183106&configID=56251&jid=9831512366&enterurl=" + enterUrl;
        //没有备用地址，2014-8-11
        var url = "http://v1.live800.com/live800/chatClient/chatbox.jsp?companyID=147557&configID=40801&jid=6145526885&enterurl=" + enterUrl;
        $(\'.live800_online\').on(\'click\', function(e) {
            e.preventDefault();
            window.open(url, \'\', \'toolbar=0,scrollbars=0,location=0,menubar=0,resizable=1,width=980,height=580\');
        });
    }); 
</script><script src="http://s5.qhimg.com/monitor/;monitor/b862fb33.js"></script>
<script>monitor.setProject(\'360_cp\').getTrack().getClickAndKeydown();</script>
<!-- 
<script src="http://s8.qhimg.com/!a04eed30/monitor131227.js" type="text/javascript"></script>
<script>moniter.getTrack();</script> -->
        <!--[if IE 6]>
			<script src="/2013/static/v1/js/src/pages/DD_belatedPNG.js" mce_src="/2013/static/v1/js/src/pages/DD_belatedPNG.js"></script>
			<script type="text/javascript">
			DD_belatedPNG.fix(\'.png\');// .png改成使用了透明PNG图片的选择器
			</script>
        <![endif]-->
    <div style="display:none" id="guanggao" endTime="2015-01-27 17:00:00" type="crazybonus04">
		<div class="panel  panel-info" style="height:273px;">
			<span class="close" style=" position:absolute; width:30px; height:30px; margin-left:395px; "> </span>
			<a href="http://cp.360.cn/crazybonus?agent=700097" target="_blank" class="link">
				<img id="popImg" src="http://p0.qhimg.com/t01ac91cc7a723eefb2.png">
			</a>
		<div>
</div></body>
</html>';
    }
}
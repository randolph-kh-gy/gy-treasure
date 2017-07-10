<?php

namespace Tests\Unit\Fetcher\RemoteApi\BwlcGovCn\Bulletin;

use GyTreasure\Fetcher\RemoteApi\BwlcGovCn\Bulletin\PrevtraxParser;
use PHPUnit\Framework\TestCase;

class PrevtraxParserTest extends TestCase
{
    public function testParse()
    {
        $parser = new PrevtraxParser();

        $rows = $parser->parse($this->_html());

        $this->assertEquals('627923', $rows[0]['issue']);
        $this->assertEquals(explode(',', '03,04,10,05,08,09,01,07,06,02'), $rows[0]['winningNumbers']);
    }

    private function _html()
    {
        // 2017-07-10 抓取的内容
        return <<<EOD
<!DOCTYPE HTML><html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>北京福彩网</title>
	<link rel="icon" type="image/x-icon" href="/favicon.ico" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="/css/base.css" />
	<link rel="stylesheet" href="/css/index.css" />
	<link rel="stylesheet" href="/css/article.css" />
	<script src="/js/jquery-1.9.1.min.js"></script>
	<script src="/js/plugin.js"></script>
    <script src="/js/util.js"></script>
	<script src="/js/juicer-min.js"></script>
      <script src="/js/alert-24.js"></script>
    <script>
        var grurl = "";
        var gsurl = "";
    </script>
  <script>juicer.set({'tag::interpolateOpen': '@{'});</script>
	<style>
	#banner img{width:624px;height:78px;margin-top:12px;}
	#topbar{height:26px;padding-left:22px;color:#ccc;padding-top: 10px;}
	.alipay{width:130px;height: 25px;position: absolute;margin: 5px 0 0 110px;}
	.acc{width:150px;position: absolute;margin: 5px 0 0 120px;padding:0 10px;color:#606060;z-index:100000;}
	.rec{width:200px;position: absolute;margin: 5px 0 0 200px;color:#606060;}
	.rec td{text-align:center;}
	.bd{background: #FFF;border: 1px solid #ccc;}
	.bb{border-bottom: 1px solid #ccc;}
	.l20{line-height: 22px;color:#666;}
	.arr{position:absolute;margin: 9px 0 0 4px;;+margin-top:5px;border-color: #ccc transparent transparent;border-style:solid dashed;border-width:7px 5px 0;line-height:0;-moz-transition:all .1s ease 0s;-webkit-transition:all .1s ease 0s;transition:all .1s ease 0s;}
	#tab_porder tr{height:20px;line-height:20px;}
	.hlinks a{display:inline;padding:3px 6px;background:#ececec;color: #333;}
	.hlinks a:hover{background:#fdd0d1;color: #333;}
	</style>
</head>
<body>
<script>
$(function(){
	var \$rec=$('.rec'),\$acc=$('.acc'),\$alipy=$('.alipay');
		$('#tz').delay(300).hover(function(){
			\$rec.show();
			var _box=$('#tab_porder');
      var tpl = $('#tpl_porder').html();      
			$.getJSON('/my/getLotteryOrders.html?startTime=2012-12-31', function(data){
          var html = juicer(tpl, data);
          _box.html(html);
          var playType=_box.find('.typeId');
		      for(var i=0;i<playType.length;i++){//翻译彩种
		      	var typeNum=playType.eq(i).html(),typeText;
		      	switch(typeNum){
		      		case '120':
						  typeText='双色球';
						  break;
						  case '121':
						  typeText='3D';
						  break;
						  case '119':
						  typeText='快乐8';
						  break;
						  case '122':
						  typeText='PK拾';
						  break;
              case '123':
						  typeText='快3';
						  break;
						  case '1000043':
						  typeText='七乐彩';
						  break;
		      	};		      	
		      playType.eq(i).html(typeText);
		      };
		      
		      for(var j=0;j<$('.status').length;j++){
          	var dcolor=$('.status').eq(j).html().replace(/(^\s+)|(\s+$)/g,""),type='';
          		switch(dcolor){
			      		case "投注成功":
							  type='rgb(6, 158, 6)';
							  break;
							  case "中奖":
							  type='rgb(245, 8, 8)';
							  break;
							  case "未中奖":
							  type='rgb(83, 81, 81)';
							  break;
							  case "等待投注":
							  type='rgb(241, 123, 14)';
							  break;
							  case "投注失败":
							  type='rgb(245, 87, 87)';
							  break;
		      	};
		      	$('.status').eq(j).css('color',type);
          }
        });
			
		},function(){
			\$rec.hide();
		});
		$('#zh').delay(300).hover(function(){
			\$acc.show();
			$.getJSON('/my/userBrief.html?t=' + new Date().getTime(), function(data) {
					$('.abalance').html(changeTwoDecimal(data.balance));
					$('.balance').html(changeTwoDecimal((parseFloat(data.balance*100)-parseFloat(data.availbalance*100))/100));
			});
		},function(){
			\$acc.hide();
		});
		$('#hz').delay(300).hover(function(){
			\$alipy.show();
		},function(){
			\$alipy.hide();
		});

		Date.prototype.Format = function (fmt) { //格式化时间
    var o = {
        "M+": this.getMonth() + 1, //月份 
        "d+": this.getDate(), //日 
        "h+": this.getHours(), //小时 
        "m+": this.getMinutes(), //分 
        "s+": this.getSeconds(), //秒 
        "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
        "S": this.getMilliseconds() //毫秒 
    };
    if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
    return fmt;
	};
		//退出		
		$('#logout').click(function(e){
                    var curUri = location.href;
					$.ajax({url:'/Login.do',data:{'resType':'json','action':'logout'},cache:false}).done(function() {
                            if (curUri.indexOf("/my/") !== -1) {
                                location.href='/';
                            } else {
                                location.reload();
                            }
					});
					e.preventDefault();//取消了事件的默认行为
				});
});
</script>
<div id="container">
	<div id="header" class="sdw">
		<div id="topbar" class="cf">
			<div class="l out pr5" >
				<div class="l20">
                    <script>
                    function gotoLogin() {
                        var url = window.location.href;
                        var from = '';
                        if (url && url.length > 0) {
                            from = url;
                        }
                        
                        window.location = "/my/login.html" + 
                                ((from.length>0)?"?from=" + encodeURI(from):"");
                    }
                    </script>
					<a href="#" onclick="gotoLogin();return false;" class="login br4">登录</a> ｜ 
					<a href="/my/reg.html">免费注册</a> ｜ 
					<span id="hz">
						<a href="javascript:;" class="pr10">合作账户登录<i class="arr"></i></a>
						<div class="alipay dn">
							<a href="/login/alipay/redirect.html"><img src="/images/zfbexpress.jpg" width="122" height="22" style="margin-bottom:-5px;*vertical-align:-5px;"/></a>
						</div>
					</span>
				</div>
				 
			</div>

			<div class="r lh22 pr10"><a href="http://bbs.bwlc.net">论坛</a>　｜　<a href="/help/faqreg.jsp">帮助中心</a>　｜　<span style="color:#606060">客服电话：010-8202 5099</span></div>
			<div class="msgBox"></div>
		</div>
		<div class="top cf">
			<a href="/" id="logo" title="北京市福利彩票发行中心"></a>
		</div>
<a href="/dl/DownloadApp.html"  title="北京市福利彩票发行中心">		<div style="margin-left:600px;margin-top:-30px;">
<img src="http://211.147.1.142:9890/images/phone.gif"/>
			
		手机客户端</div></a>
<a href="/dl/prizer.jsp"  title="北京市福利彩票发行中心">         <div style="margin-left:750px;margin-top:-38px;">
<img src="http://211.147.1.142:9890/images/phone.gif"/>

                兑奖客户端</div></a>
		<div id="navC">
<ul id="nav" class="cf ">	<li class="menuItem"><a href="/" class="db rs ml5">首页</a></li>
	<li class="menuItem">
		<a href="javascript:;" class="db">福彩资讯<i class="nav_arr"></i></a>
		<ul class="brb4">
			<li><a href="/info/index.html">福彩公告</a></li>
			<li><a href="/info/news.html">福彩新闻</a></li>
			<li><a href="/info/cover.html">中奖报道</a></li>
			<li><a href="/info/award.html">公益金使用</a></li>
      <li><a href="/info/event.html">网站专题</a></li>
			<li><a href="/info/video.html">公益北京</a></li>
		</ul>
	</li>
	<li class="menuItem"><a href="javascript:;" class="db crt">开奖公告<i class="nav_arr"></i></a>
		<ul class="brb4">
			<li><a href="/bulletin/slto.html">双色球</a></li>
			<li><a href="/bulletin/pk3.html">3D</a></li>
      <li><a href="/bulletin/qck3.html">快3</a></li>
			<li><a href="/bulletin/loto.html">七乐彩</a></li>
			<li><a href="/bulletin/keno.html">快乐8</a></li>
			<li><a href="/bulletin/trax.html">PK拾</a></li>
		</ul>
	</li>
	<li class="menuItem">
		<a href="javascript:;" class="db">游戏规则<i class="nav_arr"></i></a>
		<ul class="brb4">
			<li><a href="/help/ssq.jsp">双色球</a></li>
			<li><a href="/help/3d.jsp">3D</a></li>
			<li><a href="/help/7lc.jsp">七乐彩</a></li>
			<li><a href="/help/happy8.jsp">快乐8</a></li>
			<li><a href="/help/pk10.jsp">PK拾</a></li>
      <li><a href="/help/qck3.html">快3</a></li>
		</ul>
	</li>
	<li class="menuItem">
		<a href="javascript:;" class="db">数据分析<i class="nav_arr"></i></a>
		<ul class="brb4">
			<li><a href="/datacenter/ssq/index.html">双色球</a></li>
			<li><a href="/datacenter/3d/index.html">3D</a></li>
      <li><a href="/datacenter/qck3/index.html">快3</a></li>
      <li><a href="/datacenter/qlc/index.html">七乐彩</a></li>
		</ul>
	</li>
	<li class="menuItem"><a href="/scratch/" class="db rs">刮刮乐</a></li>
<li class="menuItem">
		<a href="javascript:;" class="db">抽奖活动<i class="nav_arr"></i></a>
		<ul class="brb4" style="display: none;">
			<li><a href="http://k3cjcj.infogrworks.com/">快3游戏</a></li>
		</ul>
	</li>	
<li class="menuItem">
		<a href="javascript:;" class="db">帮助<i class="nav_arr"></i></a>
		<ul class="brb4">
			<li><a href="/help/faqreg.jsp">如何注册</a></li>
			<li><a href="/help/faqaward.jsp">如何提奖</a></li>
			<li><a href="/help/faqfindpassword.jsp">忘记密码</a></li>
			<li><a href="/help/ssq.jsp">游戏规则</a></li>
			<li><a href="/message/mobilesms.jsp">短信订制</a></li>
		</ul>
	</li>
	<li class="menuItem"><a href="http://bbs.bwlc.net" class="db rs">论坛</a></li>
</ul>
</div>

	</div>
	<div id="marquee">
    
	<table><tr><td class="marquee_1" nowrap>
<a href="#">扶老 助残 救孤 济困</a>
<a href="#">扶老 助残 救孤 济困</a>
<a href="#">扶老 助残 救孤 济困</a>
<a href="#">扶老 助残 救孤 济困</a>
		<a href="#">扶老 助残 救孤 济困</a>
		<a href="#">扶老 助残 救孤 济困</a>
    <a href="#">扶老 助残 救孤 济困</a>
    <a href="#">扶老 助残 救孤 济困</a>
    <a href="#">扶老 助残 救孤 济困</a>
    <a href="#">扶老 助残 救孤 济困</a>
    <a href="#">扶老 助残 救孤 济困</a>
		<a href="#">扶老 助残 救孤 济困</a>
		<a href="#">扶老 助残 救孤 济困</a>
		<a href="#">扶老 助残 救孤 济困</a>
    <a href="#">扶老 助残 救孤 济困</a>
    <a href="#">扶老 助残 救孤 济困</a>
    <a href="#">扶老 助残 救孤 济困</a>
    <a href="#">扶老 助残 救孤 济困</a>
		</td>  
		<td class="marquee_2" nowrap></td></tr>
	</table>
</div>


<div id="main">
	
	<div class="mt20 cf">
		<script type="text/javascript">
	window.onload=function (){
		var oT=document.getElementById('touch');
		alert_24(oT);
	}
</script>
<div class="ml l brr10">	<h3>帮助信息<img src="/images/blt_hd.png" width="204" height="84" /></h3>
	<ul>
		<li><a href="/bulletin/slto.html">开奖公告</a></li>
        <li><a  class="cur" href="/bulletin/prevslto.html">往期开奖号查询</a></li>
        <li><a href="/bulletin/video_pk3.html"  >开奖视频</a></li>
        <li><a href="/bulletin/adrslto.html?ltype=120">出奖地址</a></li>
	</ul>
	<input type="hidden" id="myFlag" value="1">
</div>

		<script src="/js/date.mini.js"></script>
		<div class="mr" id="lottery_tabs">
			<ul class="lott_tabs dib">
					<li><a href="prevslto.html">双色球</a></li>
					<li class="cur"><a href="prevtrax.html">PK拾</a></li>
					<li><a href="prevkeno.html">快乐8</a></li>
					<li><a href="prevpk3.html">3D</a></li>
          <li><a href="prevqck3.html">快3</a></li>
					<li><a href="prevloto.html">七乐彩</a></li>
				</ul>
					<div class="lott_cont">
						<form action="prevtrax.html" style="display:inline;">
						期号<input type="text" size="10" name="num">
					<input type="submit" value="查询">
				</form>
					<form action="prevtrax.html" style="display:inline;">
					<input type="text" onfocus="SelectDate(this,'yyyy-MM-dd');" readonly="readonly" size="11" name="dates"/>
					<input type="submit" value="查询">
				</form>
					<table class="tb" width="100%">
						<tr>
							<th width="20%">期号</th>
							<th width="50%">开奖号码</th>
							<th width="30%">开奖公告</th>
						</tr>
						<tr class="">
								<td>627923</td>
								<td>03,04,10,05,08,09,01,07,06,02</td>
								<td>2017-07-10 11:07</td>
						</tr>
						<tr class="odd">
								<td>627922</td>
								<td>01,02,10,05,06,08,09,07,04,03</td>
								<td>2017-07-10 11:02</td>
						</tr>
						<tr class="">
								<td>627921</td>
								<td>04,07,10,09,02,03,01,06,08,05</td>
								<td>2017-07-10 10:57</td>
						</tr>
						<tr class="odd">
								<td>627920</td>
								<td>07,02,09,03,04,01,05,10,08,06</td>
								<td>2017-07-10 10:52</td>
						</tr>
						<tr class="">
								<td>627919</td>
								<td>08,07,02,10,09,06,05,04,01,03</td>
								<td>2017-07-10 10:47</td>
						</tr>
						<tr class="odd">
								<td>627918</td>
								<td>04,08,01,06,05,03,10,09,02,07</td>
								<td>2017-07-10 10:42</td>
						</tr>
						<tr class="">
								<td>627917</td>
								<td>05,08,04,06,01,02,09,10,03,07</td>
								<td>2017-07-10 10:37</td>
						</tr>
						<tr class="odd">
								<td>627916</td>
								<td>02,07,09,08,06,03,01,05,04,10</td>
								<td>2017-07-10 10:32</td>
						</tr>
						<tr class="">
								<td>627915</td>
								<td>01,09,08,03,05,06,07,10,04,02</td>
								<td>2017-07-10 10:27</td>
						</tr>
						<tr class="odd">
								<td>627914</td>
								<td>02,10,07,03,04,08,09,05,01,06</td>
								<td>2017-07-10 10:22</td>
						</tr>
						<tr class="">
								<td>627913</td>
								<td>07,06,01,09,08,04,05,03,02,10</td>
								<td>2017-07-10 10:17</td>
						</tr>
						<tr class="odd">
								<td>627912</td>
								<td>06,10,05,01,09,03,07,08,04,02</td>
								<td>2017-07-10 10:12</td>
						</tr>
						<tr class="">
								<td>627911</td>
								<td>08,03,07,05,06,10,01,04,02,09</td>
								<td>2017-07-10 10:07</td>
						</tr>
						<tr class="odd">
								<td>627910</td>
								<td>01,03,04,10,02,06,05,09,08,07</td>
								<td>2017-07-10 10:02</td>
						</tr>
						<tr class="">
								<td>627909</td>
								<td>07,01,10,05,02,06,04,03,09,08</td>
								<td>2017-07-10 09:57</td>
						</tr>
						<tr class="odd">
								<td>627908</td>
								<td>09,10,07,06,03,01,02,05,04,08</td>
								<td>2017-07-10 09:52</td>
						</tr>
						<tr class="">
								<td>627907</td>
								<td>10,09,02,01,08,06,07,03,05,04</td>
								<td>2017-07-10 09:47</td>
						</tr>
						<tr class="odd">
								<td>627906</td>
								<td>10,09,07,08,02,03,06,05,01,04</td>
								<td>2017-07-10 09:42</td>
						</tr>
						<tr class="">
								<td>627905</td>
								<td>04,05,07,01,09,06,03,02,10,08</td>
								<td>2017-07-10 09:37</td>
						</tr>
						<tr class="odd">
								<td>627904</td>
								<td>10,08,03,09,07,01,05,04,06,02</td>
								<td>2017-07-10 09:32</td>
						</tr>
						<tr class="">
								<td>627903</td>
								<td>08,10,02,04,06,01,07,05,09,03</td>
								<td>2017-07-10 09:27</td>
						</tr>
						<tr class="odd">
								<td>627902</td>
								<td>05,01,06,07,08,02,03,10,04,09</td>
								<td>2017-07-10 09:22</td>
						</tr>
						<tr class="">
								<td>627901</td>
								<td>01,02,10,06,03,09,04,07,05,08</td>
								<td>2017-07-10 09:17</td>
						</tr>
						<tr class="odd">
								<td>627900</td>
								<td>04,08,03,02,09,07,10,06,05,01</td>
								<td>2017-07-10 09:12</td>
						</tr>
						<tr class="">
								<td>627899</td>
								<td>04,09,05,02,01,03,10,06,07,08</td>
								<td>2017-07-10 09:07</td>
						</tr>
						<tr class="odd">
								<td>627898</td>
								<td>05,02,08,07,09,04,10,01,06,03</td>
								<td>2017-07-09 23:57</td>
						</tr>
						<tr class="">
								<td>627897</td>
								<td>10,05,01,02,06,04,03,07,08,09</td>
								<td>2017-07-09 23:52</td>
						</tr>
						<tr class="odd">
								<td>627896</td>
								<td>05,01,07,04,10,09,08,02,06,03</td>
								<td>2017-07-09 23:47</td>
						</tr>
						<tr class="">
								<td>627895</td>
								<td>10,02,04,06,07,09,01,03,08,05</td>
								<td>2017-07-09 23:42</td>
						</tr>
						<tr class="odd">
								<td>627894</td>
								<td>02,10,09,01,04,06,05,03,07,08</td>
								<td>2017-07-09 23:37</td>
						</tr>
					</table>
					<div class="fc_fanye">
	          <span>记录<b class="col_red">419845</b>条</span>
            <span>共<b class="col_red">13995</b>页</span>
            <span>第<b class="col_red pageNum">1</b>页</span>
            <a class="firstPage" href="/bulletin/prevtrax.html">首页</a>
            <a class="prePage" href="/bulletin/prevtrax.html?page=1">上一页</a>
            <a class="nextPage" href="/bulletin/prevtrax.html?page=2">下一页</a>
            <a class="lastPage" href="/bulletin/prevtrax.html?page=13995">尾页</a>
	        </div>
				</div>
		</div>
	</div>
</div>
		<div id="footer">		<dl id="channel" class="mt5">
			<dt class="brt4">客服电话：010-8202 5099</dt>
			<dd class="brb4 cf menu">
				<div class="l lbn">
					<h3>游戏规则</h3>
					<ul class="dot">
						<li><a href="/help/ssq.jsp">双色球</a></li>
						<li><a href="/help/3d.jsp">3D</a></li>
                        <li><a href="/help/qck3.html">快3</a></li>
						<li><a href="/help/7lc.jsp">七乐彩</a></li>
						<li><a href="/help/happy8.jsp">快乐8</a></li>
						<li><a href="/help/pk10.jsp">PK拾</a></li>
					</ul>
				</div>
				<div class="l">
					<h3>开奖公告</h3>
					<ul class="dot">
					<li><a href="/bulletin/slto.html">双色球</a></li>
					<li><a href="/bulletin/pk3.html">3D</a></li>
                    <li><a href="/bulletin/qck3.html">快3</a></li>
					<li><a href="/bulletin/loto.html">七乐彩</a></li>
					<li><a href="/bulletin/keno.html">快乐8</a></li>
					<li><a href="/bulletin/trax.html">PK拾</a></li>
					</ul>
				</div>
				<div class="l">
					<h3>走势分析</h3>
					<ul class="dot">
							<li><a href="/datacenter/ssq/index.html">双色球</a></li>
							<li><a href="/datacenter/3d/index.html">3D</a></li>
                            <li><a href="/datacenter/qck3/index.html">快3</a></li>
                            <li><a href="/datacenter/qlc/index.html">七乐彩</a></li>
					</ul>
				</div>
				<div class="l">
					<h3>用户服务</h3>
					<ul class="dot">
							<li><a href="/register.jsp">注册用户</a></li>
<li><a href="/my/refund.html">提取奖金</a></li>
                                                        <li><a href="/my/fpassword.html">忘记密码</a></li>
							<li><a href="/message/mobilesms.jsp">短信订制</a></li>
					</ul>
				</div>
			</dd>
		</dl>
		<div id="copyright">
			<a target="_blank" href="/footer/about_us.jsp">关于我们</a>
			&nbsp;|&nbsp;
			<a target="_blank" href="/footer/contact_us.jsp">联系我们</a>
			&nbsp;|&nbsp;
			<a target="_blank" href="/footer/map.jsp">网站地图</a>
			&nbsp;|&nbsp;
			<a target="_blank" href="/footer/link.jsp">友情链接</a>
			&nbsp;|&nbsp;
			<a target="_blank" href="/footer/policy.jsp">隐私条款</a>
			&nbsp;|&nbsp;
			<a target="_blank" href="/footer/agreement.jsp">服务协议</a>
			&nbsp;|&nbsp;
			<a target="_blank" href="/footer/job.jsp">诚聘英才</a>
<div style="overflow:hidden; line-height:24px;height:24px;">
		<span style="float:left; margin-left:160px;">北京市福利彩票发行中心版权所有 京ICP备09069186号</span>
 		<a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010202007232" style="float:left;text-decoration:none;margin-left:6px;">
	 		<img src="http://static.bwlc.net/images/beian_icon.png" style="float:left; margin-top:2px;"/>
	 		<p style="float:left;margin: 0px 0px 0px 5px; font-size:12px;">京公网安备 11010202007232号</p>
 		</a>
	</div>			
<span class="noice">未成年人不允许购买彩票</span>
		</div>
	</div>
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1260158960'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1260158960' type='text/javascript'%3E%3C/script%3E"));</script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?d1cdc5cd5c769566cc0031ce552afe4e";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
<a href="http://webscan.360.cn/index/checkwebsite/url/www.bwlc.net"><img border="0" src="http://img.webscan.360.cn/status/pai/hash/08de8af2a2f3905a18bd34878c77f740"/></a>

  <div style="text-align: right;margin-top:-100px;padding-right:20px;padding-bottom: 40px;">
  <script type="text/javascript">document.write(unescape("%3Cspan id='_ideConac' %3E%3C/span%3E%3Cscript src='http://dcs.conac.cn/js/01/000/0000/60436217/CA010000000604362170002.js' type='text/javascript'%3E%3C/script%3E"));</script>
</div>
</div>

<div style="height:0px;line-height: 0px;overflow: hidden;">
<script>
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F59f2f67e65fdaf7d9a2055f2c512fbc0' type='text/javascript'%3E%3C/script%3E"));
</script>
</div>
</body>
</html>
EOD;
    }
}

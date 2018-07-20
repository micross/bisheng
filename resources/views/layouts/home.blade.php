<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" >
<meta name="renderer" content="webkit">
<meta name="keywords" content=""/>
<meta name="description" content=""/>
<meta property="wb:webmaster" content="8af72a3a7309f0ee">
    <title>虚拟币交易网站</title>
	<link rel="Shortcut Icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/subpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    <link rel="stylesheet" href="{{ asset('css/coin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/zcpc.css') }}">
    <link rel="stylesheet" href="{{ asset('iconfont/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('iconfont/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jb_style.css') }}">
    <script src="{{ asset('js/jquery-1.js') }}"></script>
    <script src="{{ asset('js/downList.js') }}"></script>
    <script src="{{ asset('js/jquery-1.8.2.js') }}"></script>
    <script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/layer/layer.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/messages_zh.min.js') }}"></script>
    <script src="{{ asset('js/base.js') }}"></script>

</head>
<body>
<div style="background:#f9f9f9; height:30px;">
    <div style="width:1000px; margin:0 auto;">
        <ul class="qqkf left" style="line-height:30px; color:#999;">
            <li class="phone"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $config['qq1'] }}&site=qq&menu=yes" class="qq_qq"></a>{{ $config['qq1'] }}</li>
            <li class="phone400">{{ $config['tel'] }}</li>
            <li class="phone_email"><a href="mailto:{{ $config['email'] }}">{{ $config['email'] }}</a></li>
            <li>&nbsp;&nbsp;工作日:9-19时 节假日:9-18时</li>
        </ul>
		@auth
                <div class="person right">
                    <a class="left myhome" href="{:U('ModifyMember/modify')}" style=" height:30px; line-height:30px; margin-right:5px;">
                        {$username} </a>
                        
                    <div style="display: none;" class="mywallet_list"><div class="clear"><ul class="balance_list"><h4>可用余额</h4><li><a href="javascript:void(0)"><em style="margin-top: 5px;" class="deal_list_pic_cny"></em><strong>人民币：</strong><span>{$member.rmb}</span></a></li></ul><ul class="freeze_list"><h4>委托冻结</h4><li><a href="javascript:void(0)"><em style="margin-top: 5px;" class="deal_list_pic_cny"></em><strong>人民币：</strong><span>{$member.forzen_rmb}</span></a></li></ul></div><div class="mywallet_btn_box"><a href="{:U('User/pay')}">充值</a><a href="{:U('User/draw')}">提现</a><a href="{:U('User/index')}">转入</a><a href="{:U('User/index')}">转出</a><a href="{:U('Entrust/manage')}">委托管理</a><a href="{:U('Trade/myDeal')}">成交查询</a></div></div>
                    <span class="left" style="height:30px; line-height:30px; color:#999; margin-right:5px;">(UID: {$Think.session.USER_KEY_ID} )</span>
                    <a class="left" href="{:U('Login/loginOut')}" style="height:30px; line-height:30px; margin:0 5px;">退出</a>
                    <div id="my" class="account left" href="javascript:void(0)" style="z-index:9997; margin-right:5px;">
                        <a class="user_me" href="{:U('User/index')}">我的账户</a>
                        <ul class="accountList" style="padding: 6px 0px; background: rgb(85, 85, 85) none repeat scroll 0% 0%; border-radius: 5px 0px 5px 5px; display: none;">
                            <li><a href="{:U('User/index')}">我的资产</a></li>
                            <li><a href="{:U('Entrust/manage')}">我的交易</a></li>
                            <li><a href="{:U('User/zhongchou')}">我的众筹</a></li>
                            <li style="border-top:1px solid #666;"><a href="{:U('User/pay')}">人民币充值</a></li>
                            <li><a href="{:U('User/draw')}">人民币提现</a></li>
                            <li style="border-bottom:1px solid #444;"><a href="{:U('User/index')}">充币提币</a></li>
                            <li><a href="{:U('User/updatePassword')}">修改密码</a></li>
                            <li><a href="{:U('User/sysMassage')}">系统消息<if condition="$newMessageCount"><span class="messagenum">{$newMessageCount}</span></if></a></li>
                        </ul>
                    </div>
                </div>
            </if>
		@endauth
		@guest
				<div class="loginArea right" style=" margin-right:5px;">
            	<a href="{{ url('login/index') }}" style="color:#f60; font-size:14px;">登录</a>
            	<span class="sep">&nbsp;|&nbsp;</span>
            	<a href="{{ url('reg/reg') }}" style="color:#f60; font-size:14px;">注册</a>
        		</div>
		@endguest
    </div>
</div>
<div class="top">
    <div class="wapper clearfix">
        <h1 class="left"><a href="{{ url('index/index') }}"><img style=" width:280px; height:70px;" src="{{ $config['logo'] }}" alt="虚拟币" title="虚拟币"></a></h1>
        <ul class="nav right" style="z-index:9995;">
            <li><a href="{{ url('/') }}">首页</a></li>
            <li><a href="{{ url('orders/currency_trade') }}">交易大厅</a></li>
            <li><a href="{{ url('zhongchou/index') }}">认购中心</a></li>
            <li><a href="{{ url('safe/index') }}">用户中心</a></li>
            <li><a href="{{ url('help/index',array('id'=>60)) }}">帮助中心</a></li>
            <li><a href="{{ url('art/index',array('ramdon_id'=>'1')) }}">最新动态</a></li>
            <li><a href="{{ url('market/index') }}">行情中心</a></li>
            <li><a href="{{ url('dow/index') }}">下载中心</a></li>
        </ul>
    </div>
</div>
<div class="pclxfsbox"> 
		<ul> 
			<li id="opensq">
				<i class="pcicon1 iscion6" ></i>
				<div class="pcicon1box">
					<div class="iscionbox" >
						<p>在线咨询</p>
						<p>{{ $config['worktime'] }}</p>
					</div>
					<i></i>
				</div>
			</li>
			<li> 
				<i class="pcicon1 iscion1"></i>
				<div class="pcicon1box">
					<div class="iscionbox">
						<p><img src="{{ $config['weixin'] }}" alt="投筹网微信公众号" width="108"></p>
						<p>{{ $config['name'] }}微信群</p>
					</div>
					<i></i>
				</div>
			</li>
			<li>
				<i class="pcicon1 iscion2"></i>
				<div class="pcicon1box">
					<div class="iscionbox">
						<p>{{ $config['tel'] }}</p>
						<p>{{ $config['name'] }}</p>
					</div>
					<i></i>
				</div>
			</li>
           <li>
				<i class="pcicon1 iscion3"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $config['qq1'] }}&site=qq&menu=yes"></a></i>
				<div class="pcicon1box">
					<div class="iscionbox">
						<p>{{ $config['qq1'] }}</p>
						<p>{{ $config['name'] }}QQ在线客服1</p>
					</div>
					<i></i>
				</div>
			</li>
            <li>
				<i class="pcicon1 iscion3" style="background:url({{ asset('images/kefu2.png') }}) no-repeat #9b9b9b;background-position:-144px 11px;"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $config['qq2'] }}&site=qq&menu=yes"></a></i>
				<div class="pcicon1box">
					<div class="iscionbox">
						<p>{{ $config['qq2'] }}</p>
						<p>{{ $config['name'] }}QQ在线客服2</p>
					</div>
					<i></i>
				</div>
			</li>
            <li>
				<i class="pcicon1 iscion3" style="background:url({{ asset('images/kefu3.png') }}) no-repeat #9b9b9b;background-position:-144px 11px;"><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin={{ $config['qq3'] }}&site=qq&menu=yes"></a></i>
				<div class="pcicon1box">
					<div class="iscionbox">
						<p>{{ $config['qq3'] }}</p>
						<p>{{ $config['name'] }}QQ在线客服3</p>
					</div>
					<i></i>
				</div>
			</li>
			
			<li>
				<i class="pcicon1 iscion4"></i>
				<div class="pcicon1box">
					<div class="iscionbox">
						<p>返回顶部</p>
					</div>
					<i></i>
				</div>
			</li>
		</ul>
	</div>
    <script type="text/javascript"> 
		$(function(){
			$(".pcicon1").on("mouseover",function(){
				$(this).addClass("lbnora").next(".pcicon1box").css({"width":"148px"});
			}).on("mouseout",function(){
				$(this).removeClass("lbnora").next(".pcicon1box").css("width","0px");
			});
			$(".iscion4").on("click",function(){
				$("html, body").animate({
					scrollTop: 0
				})
			});

			var objWin;
			$("#opensq").on("click",function(){
				var top = window.screen.height/2 - 250;
				var left = window.screen.width/2 - 390;
				var target = "http://p.qiao.baidu.com//im/index?siteid=8050707&ucid=18622305"; 
				var cans = 'width=780,height=550,left='+left+',top='+top+',toolbar=no, status=no, menubar=no, resizable=yes, scrollbars=yes' ;

				if((navigator.userAgent.indexOf('MSIE') >= 0)&&(navigator.userAgent.indexOf('Opera') < 0)){
						if (objWin === undefined || objWin === null || objWin.closed) { 
							objWin = window.open (target,'baidubridge',cans) ; 
						}else { 
							objWin.focus();
						}
				}else{
					var win = window.open('','baidubridge',cans );
					if (win.location.href == "about:blank") {
					    //窗口不存在
					    win = window.open(target,'baidubridge',cans);
					} else {
					    win.focus();
					}
				}
				return false;

			})
		})
		
	</script>
<!--top end-->

<script>
$(".myhome").hover(function(){
	$(".mywallet_list").show();	
},function(){
	$(".mywallet_list").hover(function(){
		$(".mywallet_list").show();	
	},function(){
		$(".mywallet_list").hide();	
	});
	$(".mywallet_list").hide();
});
</script>

@yield('content')
@extends('layouts.home')

@section('content')

<style>
.pull-left{ float:left;}
.pull-right{ float:right;}
.link a{ color:#000;}
.link{ margin:0px auto; width:100%;}
</style>

<script src="{{ asset('js/focus.js') }}"></script>
<script src="{{ asset('js/Fnc.js') }}"></script>
<script src="{{ asset('js/zc.js') }}"></script>
<script src="{{ asset('js/1.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery.flexslider-min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/hb_index.css') }}">
<link rel="stylesheet" href="{{ asset('css/zc.css') }}">
<link rel="stylesheet" href="{{ asset('css/flexslider.css') }}">
<!--banner start-->
<div style="height:360px; width:100%; position:relative; overflow:hidden; min-width:1200px;">

<div>
	<div class="flexslider">
		<ul class="slides">
            @foreach($flash as $item)
            	<li><a href="//{{ $item['jump_url'] }}" target="_blank"><img src="{{ $item['pic'] }}" alt="{{ $item['title'] }}" style="height:320px;"></a></li>
            @endforeach
		</ul>
	</div>
	<div class="ybcoin_volume">
		<div style="color:#fff;">
			<p style=" font-size:16px; margin-bottom:5px; text-align: center;">风险提示</p>
			<p style=" font-size:12px; line-height:22px;">{{ $config['risk_warning'] }}</p>
		</div>
			<div class="news_coin">
                @auth
                <a href="{:U('User/index')}">我的账户</a>
                @endauth
                @guest
                <a href="{:U('Login/index')}">立即登录</a>
                @endguest
            </div>
			<p class="coin_reg">
                @auth
                <a href="{:U('Dow/newcoin')}" class="right">我要上新币</a>
                @endauth
                @guest
                <a href="{:U('Reg/reg')}" class="left">免费注册</a>
                @endguest
            </p>
			</div>
</div>
</div>
<!--banner end-->
<div class="ybcoin_section clearfix" style="border:0;">
    <!--币币交易开始-->
    <div id="tags_coin" class="coinarea left" style="position:relative;">
        <div class="bgcolor" style="display:none;"></div>
        <div style="margin-top:30px;" id="tagContent">
            <!-- 对CNY交易区 结束-->
            <div class="tagContent selectTag" id="tagContent0">
                 <p style="color:#f00; font-size:14px; margin-bottom:10px;">{!! $config['friendship_tips'] !!}</p>
                <table class="coin_list coinarea" border="0" cellpadding="0" cellspacing="0">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th style="text-align:left;">币  名</th>
                        <th class="header">最新价格(CNY)</th>
                        <th class="header">24H成交量</th>
                        <th class="header">24H成交额(CNY)</th>
                        <th class="header">总市值(CNY)</th>
                        <th class="header">24H涨跌</th>
                        <th class="header">7D涨跌</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($currency as $vo)
                        <tr class="coin_num">
                            <td><a href="{{ url('orders/index', ['currency'=>$vo['currency_mark']]) }}"><img src="{{ $vo['currency_logo'] }}" style="width:20px; height:20px;"></a></td>
                            <td class="coin_name"><a href="{{ url('orders/index', ['currency'=>$vo['currency_mark']]) }}">{{ $vo['currency_name'] }}{{ $vo['currency_mark'] }}</a></td>
                            <td>
                                <eq name='vo.new_price_status' value='0' >
                                    <a href="{:U('Orders/index',array('currency'=>$vo['currency_mark']))}" class="buy"><else/><a href="{:U('Orders/index',array('currency'=>$vo['currency_mark']))}" class="sell">
                                </eq>
                                {{ $vo['new_price'] }}<eq name='vo.new_price_status' value='0'>↓<else/>↑</eq></a></td>
                            <td><a href="{{ url('orders/index', ['currency'=>$vo['currency_mark']]) }}">{{ $vo['24H_done_num'] }}</a></td>
                            <td><a href="{{ url('orders/index', ['currency'=>$vo['currency_mark']]) }}">{{ $vo['24H_done_money'] }}</a></td>
                            <td><a href="{{ url('orders/index', ['currency'=>$vo['currency_mark']]) }}">{$vo.currency_all_money|default='0'}</a></td>
                            <td>
                                <gt name='vo.24H_change' value='0'>
                                    <a href="{{ url('orders/index', ['currency'=>$vo['currency_mark']]) }}" class="sell">
                                        <else/><a href="{:U('Orders/index',array('currency'=>$vo['currency_mark']))}" class="buy"></gt>{$vo.24H_change|default='0'}%</a></td>
                            <td>
                                <gt name='vo.7D_change' value='0'>
                                    <a href="{{ url('orders/index', ['currency'=>$vo['currency_mark']]) }}" class="sell">+<else/><a href="{:U('Orders/index',array('currency'=>$vo['currency_mark']))}" class="buy"></gt>{$vo.7D_change|default='0'}%</a></td>
                        </tr>
                    @empty
                       暂无数据
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--币币交易结束-->
    <div class="right coin_news">
        <div class="news_title clearfix">
            <h2 class="left">官方公告</h2>
            <a href="{:U('Art/index',array('id'=>'1'))}" class="right">更多</a>
        </div>
        <ul>
                @foreach($info_red1 as $vo)
                <li>
                    <a href="{:U('Art/details',array('id'=>$vo_red1['article_id']))}">
                        <span class="coin_news_title left" style="color:red;font-weight:bold;">{{ $vo_red1->title }}</span>
                        <span class="right">{{ $vo_red1['add_time'] }}</span>
                    </a>
                </li>
                @endforeach
            <volist name="info1" id="vo1">
                <li>
                    <a href="{:U('Art/details',array('id'=>$vo1['article_id']))}">
                        <span class="coin_news_title left">{$vo1.title}</span>
                        <span class="right">{$vo1.add_time|date='m-d',###}</span>
                    </a>
                </li>
            </volist>
        </ul>
        <div class="news_title clearfix" style="margin-top:20px;">
            <h2 class="left">市场动态</h2>
            <a href="{:U('Art/index',array('id'=>'2'))}" class="right">更多</a>
        </div>
        <ul>
        <volist name="info_red2" id="vo_red2">
        
            <li>
                <a href="{:U('Art/details',array('id'=>$vo_red2['article_id']))}">
                    <span class="coin_news_title left" style="color:red;font-weight:bold;">{$vo_red2.title}</span>
                    <span class="right">{$vo_red2.add_time|date='m-d',###}</span>
                </a>
            </li>
        </volist>
        </ul>
        <ul>
            <volist name="info2" id="vo2">
                <li><a href="{:U('Art/details',array('id'=>$vo2['article_id']))}"><span class="coin_news_title left">{$vo2.title}</span><span class="right">{$vo2.add_time|date='m-d',###}</span></a></li>
            </volist>
        </ul>
    </div>
</div>
<div class="index_box_2 slogan" style="width:1200px; margin:0px auto; margin-top:30px;">

    <div class="slogan_title">选择{{ $config['name'] }},安全可信赖</div>
        <div class="slogan_tis">累计交易额:<span id="yi"><span>{{ $sum_money }}</span></div>
        <div id="cumulative">
          <div class="number_box">
             <volist name="arr" id="vo" key="key">
                 <div <if condition=" $key%3 eq 0 && $key%12 eq 0  ">class="unit add_f"
                        <elseif condition=" $key%3 eq 0 "/>class="unit add_w"
                        <else/>class="unit"
                    </if> >
                     <div class="top"><span>{$vo}</span></div>
                     <div style="" class="top"><span>{$vo}</span></div>
                     <div class="btm"><span>{$vo}</span></div>
                     <div style="transform: rotateX(0deg);" class="btm"><span>{$vo}</span></div>
                 </div>
             </volist>

    </div>
</div>
</div>
<script src="{{ asset('js/coinindex.js') }}"></script>
<script src="{{ asset('js/tab.js') }}"></script>
<script src="{{ asset('js/slide.js') }}"></script>
<script src="{{ asset('js/hb_lang.js') }}"></script>
<script src="{{ asset('js/hb_sea.js') }}"></script>
<script src="{{ asset('js/hb_hm.js') }}"></script>
<script>
    seajs.use("dist/page_index");
    /**/
    function change_vcode(e) {
        e.src = "/account/captcha?" + Math.random();
    }
    /**/

</script>

<!-- 客服信息 -->
<div class="autobox">
    <ul class="web_service clear pl30">
        <li class="w265"><a id="BizQQWPA" href="http://wpa.qq.com/msgrd?v=3&uin={{ $config['qq1'] }}&site=qq&menu=yes"><div class="web_service_pic service_1"></div><div class="web_service_pic_num"><p>{{ $config['qq1'] }}</p><div class="qqsecvice">在线QQ客服</div></div></a></li>
        <li class="w245"><div class="web_service_pic service_2"></div><div class="web_service_pic_num"><p>{{ $config['tel'] }}</p><div>工作日:9-19时 节假日:9-18时</div></div></li>
        <li class="w265"><a href="http://weibo.com/{{ $config['weibo'] }}" target="_blank"><div class="web_service_pic service_3"></div>
            <div class="web_service_pic_num"><p>{{ $config['weibo'] }}</p><div>新浪官方微博</div></div></a></li>
        <li><div class="web_service_pic service_4"></div><div class="web_service_pic_num"><p>2群：{{ $config['qqqun2'] }}</p>
            <div class="h_underl">交流QQ群</div></div></li>
    </ul>
</div>



<div class="safety_tips">
    <div style="border-top:#d8d8d8 dotted 1px;width: 1000px; margin: 0 auto; margin-bottom: 20px;"></div>
    <h3>专业的安全保障</h3>
    <div class="autobox">
        <ul class="safety_tips_ul clear">
            <li>
                <img src="/Public/Home/images/safe_1.jpg" alt="" height="70" width="70">
                <h4>系统可靠</h4>
                <p>银行级用户数据加密、动态身份验证，多级风险识别控制，保障交易安全</p>
            </li>
            <li>
                <img src="/Public/Home/images/safe_2.jpg" alt="" height="70" width="70">
                <h4>资金安全</h4>
                <p>钱包多层加密，离线存储于银行保险柜，资金第三方托管，确保安全</p>
            </li>
            <li>
                <img src="/Public/Home/images/safe_3.jpg" alt="" height="70" width="70">
                <h4>快捷方便</h4>
                <p>充值即时、提现迅速，每秒万单的高性能交易引擎，保证一切快捷方便</p>
            </li>
            <li>
                <img src="/Public/Home/images/safe_4.jpg" alt="" height="70" width="70">
                <h4>服务专业</h4>
                <p>专业的客服团队，400电话和24小时在线QQ，VIP一对一专业服务</p>
            </li>
        </ul>
    </div>
</div>
<!--友情链接-->
<div class="link">
    <div class="linkbox">
        <h4>友情链接</h4>
        <ul>
            @foreach($link_info as $vo)
                <li><a target="_blank" href="{{ $vo['url'] }}" style=" font-size:16px;">{{ $vo->name }}</a> </li>
            @endforeach

        </ul>
    </div>
</div>

<script>
$(function() { 
    $(".flexslider").flexslider({
		directionNav: true,
		pauseOnAction: false
});
});

</script>


@endsection
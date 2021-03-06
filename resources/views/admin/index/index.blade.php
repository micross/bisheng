@extends('layouts.admin')

@section('content')

<div class="main-wrap">
    <div class="crumb-wrap">
        <div class="crumb-list"><i class="icon-font"></i>首页</div>
    </div>
    <div class="result-wrap">
        <div class="result-title">
            <h1>快捷操作</h1>
        </div>
        <div class="result-content">
            <div class="short-wrap">
                <li>当前登录管理员：{$admin_user.name|default='admin'}</li>
            </div>
        </div>
    </div>
    <div class="result-wrap">
        <div class="result-title">
            <h1>服务器信息</h1>
        </div>
        <div class="result-content">
            <table class="result-tab" width="100%">
                <tr>
                    <td width="20%">系统版本</td>
                    <td width="20%">{:php_uname('r')}</td>
                    <td width="20%">服务器操作系统</td>
                    <td width="40%">{:php_uname('s')}</td>
                </tr>
                <tr>
                    <td>运行环境</td>
                    <td>{:php_sapi_name()}</td>
                    <td>PHP版本</td>
                    <td>{:PHP_VERSION}</td>
                </tr>
                <tr>
                    <td>MySql版本</td>
                    <td>{:mysqlnd}</td>
                    <td>服务器IP</td>
                    <td>{:GetHostByName($_SERVER['SERVER_NAME'])}</td>
                </tr>
                <tr>
                    <td>你的IP</td>
                    <td>{:$_SERVER['REMOTE_ADDR']}</td>
                    <td>服务器端口</td>
                    <td>{:$_SERVER['SERVER_PORT']}</td>
                </tr>
                <tr>
                    <td>绝对路径</td>
                    <td>{:$_SERVER['DOCUMENT_ROOT']}</td>
                    <td>网站域名</td>
                    <td>{:$_SERVER['SERVER_NAME']}</td>
                </tr>
                <tr>
                    <td>清理缓存</td>
                    <td><input type="button" id="button" value="清理缓存"/></td>
                    <input type="hidden" id="type" value="Runtime-Cache"/>
                    <td>网站开发</td>
                    <td><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=275043418&site=qq&menu=yes"><img border="0" src="__PUBLIC__/Admin/images/QQ.png" alt="点击这里给我发消息" title="点击这里给我发消息"/></a></td>
                </tr>
                <tr>
                    <td>官网地址</td>
                    <td>{:$_SERVER['SERVER_NAME']}</td>
                    <td>版权所有</td>
                    <td>{:$config['copyright']}</td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        $(function(){
            $('#button').click(function(){
                if(confirm("确认要清除缓存？")){
                    var $type=$('#type').val();
                    $.post("{:U('Index/cache')}",{type:$type},function(data){
                        alert("缓存清理成功");
                    });
                }else{
                    return false;
                }});
        });
    </script>
</div>
<!--/main-->
</div>
</body>
</html>

@endsection
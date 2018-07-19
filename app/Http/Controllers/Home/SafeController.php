<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SafeController extends Controller
{
    public function index(Request $request)
    {
        $u_info = M('Member')->where("member_id = {$_SESSION['USER_KEY_ID']}")->find();


        $this->assign('u_info', $u_info);
        $this->assign('empty', '暂无数据');
        $this->display();
    }
    public function mobilebind(Request $request)
    {
        
        $this->assign('empty', '暂无数据');
        $this->display();
    }
}

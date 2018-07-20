<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->display();
    }
    //登录验证
    public function checkLogin(Request $request)
    {
        $username = trim(I('post.username'));
        $pwd = trim(I('post.pwd'));
        if (empty($username) || empty($pwd)) {
            $this->error('请填写完整信息');
        }
        $admin = M('Admin')->where("username='$username'")->find();
        if ($admin['password'] != md5($pwd)) {
            $this->error('登录密码不正确');
        }
        $_SESSION['admin_userid'] = $admin['admin_id'];
        $this->redirect('Index/index');
    }

    //登出
    public function loginout(Request $request)
    {
        $_SESSION['admin_userid'] = null;
        $this->redirect('Login/login');
    }
}

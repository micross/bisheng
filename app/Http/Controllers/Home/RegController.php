<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class RegController extends Controller
{
    public function index(Request $request)
    {
        $pid = $request->query('pid');
        return view('home.reg.reg', compact($pid));
    }

    public function terms(Request $request)
    {
        return view('home.reg.terms');
    }

    public function addReg(Request $request)
    {
        $_POST['reg_time'] = time();
        $_POST['ip'] = get_client_ip();
        $M_member = D('Member');
        if ($_POST['pwd'] == $_POST['pwdtrade']) {
            $data['status'] = 0;
            $data['info'] = "交易密码不能和密码一样";
            $this->ajaxReturn($data);
            return;
        }
        if (!$M_member->create()) {
            // 如果创建失败 表示验证没有通过 输出错误提示信息
            $data['status'] = 0;
            $data['info'] = $M_member->getError();
            $this->ajaxReturn($data);
            return;
        } else {
            $r = $M_member->add();
            if ($r) {
                session('USER_KEY_ID', $r);//传入session避免直接进入个人信息界面
                session('USER_KEY', $_POST['email']);//用户名
                session('STAUTS', 0);
                session('procedure', 1);//SESSION 跟踪第一步
                $data['status'] = 1;
                $data['info'] = '提交成功';
                $this->ajaxReturn($data);
            } else {
                $data['status'] = 0;
                $data['info'] = '服务器繁忙,请稍后重试';
                $this->ajaxReturn($data);
            }
        }
    }

    /**
     * 注册成功
     */
    public function regSuccess(Request $request)
    {
        if (session('USER_KEY_ID')) {
            $this->redirect('User/index');
            return;
        }
        //判断步骤并重置
        if (session('procedure') == 2) {
            session('procedure', null);
            $this->display();
        }
        if (session('procedure') == 1) {
            $this->redirect('Reg/reg');
        }
    }

    public function checkEmail(Request $request)
    {
        $email = urldecode($request->query('email'));
        $data = [];
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data['status'] = 0;
            $data['msg'] = '邮箱格式错误';
        } else {
            $r = Member::where('email', $email)->exists();
            if ($r) {
                $data['status'] = 0;
                $data['msg'] = '邮箱已存在';
            } else {
                $data['status'] = 1;
                $data['msg'] = '';
            }
        }
        
        return $data;
    }
}

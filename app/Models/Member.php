<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';

    public function checkPwd($pwd)
    {
        $pattern="/^[1-9|a-z|A-Z]{6,20}$/";
        if (preg_match($pattern, $pwd)) {
            return true;
        } else {
            return false;
        }
    }

    public function logCheckEmail($email)
    {
        $where['email'] = $email;
        $info = $this->where($where)->find();
        if ($info) {
            return $info;
        } else {
            return false;
        }
    }

    public function logCheckMo($mo)
    {
        $where['phone'] = $mo;
        $info = $this->where($where)->find();
        if ($info) {
            return $info;
        } else {
            return false;
        }
    }

    function checkPhoneCode($code)
    {
        if (session('code')!=$code) {
            return  false;
        } else {
            return true;
        }
    }
}

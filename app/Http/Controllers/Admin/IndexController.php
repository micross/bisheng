<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $uid = $_SESSION['admin_userid'];
        $admin_user = M("Admin")->where("admin_id='$uid'")->find();
        
        $config = M("Config")->field('key,value')->select();
        foreach ($config as $k => $v) {
            $config[$v['key']] = $v['value'];
        }

        $URL_MODULE_MAP = array_keys(C('URL_MODULE_MAP'))[0];
        $adminquanxian = M("Admin")->field('Nav')->where("admin_id='{$_SESSION['admin_userid']}'")->find();
        $rules = $adminquanxian['nav'];
        if (empty($rules)) {
            $this->error('此账号尚未分配权限', $URL_MODULE_MAP . '/Login/login');
        }
        $rules = explode(',', $rules);
        foreach ($rules as $k => $v) {
            $list[] = M("Nav")->where('nav_id=' . $v)->find();
        }
        foreach ($list as $k => $v) {
            $v['nav_url'] = '/' . $URL_MODULE_MAP . $v['nav_url'];
            $value[$v['cat_id']][] = $v;
        }
        foreach ($value as $k => $v) {
            $this->assign($k . "_nav", $v);
        }
        $this->assign('URL_MODULE_MAP', $URL_MODULE_MAP);
                
        return view('admin.index.index');
    }

    /**
     * 统计全站信息
     */
    public function infoStatistics(Request $request)
    {
        //统计全站信息
        //总人数
        $member_count = M('Member')->count();
        //众筹总数量
        $issue_count = M('issue')->field("sum(num)-sum(deal) as count")->find();
        //人民币收入
        $pay_money_count = M('pay')->where("status = 1 ")->sum('count');
        //人民币支出
        $withdraw_money_count = M('withdraw')->where(" status = 2")->sum("money");
        //充值单数
        $pay_count = M('pay')->where("status = 1 ")->count();
        //提现单数
        $withdraw_count = M('withdraw')->where(" status = 2")->count();
        //全站币种统计
        $currency_u_info = M('currency')
                        ->alias('a')
                        ->field('a.currency_name,sum(b.num) as num,sum(b.forzen_num) as forzen_num')
                        ->join("left join " . C("DB_PREFIX") . "currency_user AS b on a.currency_id = b.currency_id")
                        ->group('a.currency_id')
                        ->select();
        $this->assign('member', $member_count);
        $this->assign('issue_count', $issue_count);
        $this->assign('pay_money_count', $pay_money_count);
        $this->assign('withdraw_money_count', $withdraw_money_count);
        $this->assign('pay_count', $pay_count);
        $this->assign('withdraw_count', $withdraw_count);
        $this->assign('currency_u_info', $currency_u_info);
        $this->display();
    }

    /**
     * 删除缓存方法
     */
    public function cache(Request $request)
    {
        $cacheDir = $_POST['type'];
        $type = $cacheDir;
        //将传递过来的值进行切割，我是已“-”进行切割的
        $name = explode('-', $type);
        //得到切割的条数，便于下面循环
        $count = count($name);
        //循环调用上面的方法
        for ($i = 0; $i < $count; $i++) {
            //得到文件的绝对路径
            $abs_dir = dirname(dirname(dirname(dirname(__FILE__))));
            //组合路径
            $pa = $abs_dir . str_replace("/", "\\", str_replace("./", "\\", RUNTIME_PATH)); //得到运行时的目录
            $runtime = $pa . 'common~runtime.php';
            if (file_exists($runtime)) {//判断 文件是否存在
                unlink($runtime); //进行文件删除
            }
            //调用删除文件夹下所有文件的方法
            $this->rmFile($pa, $name[$i]);
        }
        $data['status'] = 1;
        $data['info'] = "清理成功";
        $this->ajaxReturn($data);
    }

    /**
     * 删除文件和目录
     * @param type $path 要删除文件夹路径
     * @param type $fileName 要删除的目录名称
     */
    private function rmFile($path, $fileName)
    {
//删除执行的方法
        //去除空格
        $path = preg_replace('/(\/){2,}|{\\\}{1,}/', '/', $path);
        //得到完整目录
        $path .= $fileName;
        //判断此文件是否为一个文件目录
        if (is_dir($path)) {
            //打开文件
            if ($dh = opendir($path)) {
                //遍历文件目录名称
                while (($file = readdir($dh)) != false) {
                    $sub_file_path = $path . "\\" . $file;
                    if ("." == $file || ".." == $file) {
                        continue;
                    }
                    if (is_dir($sub_file_path)) {
                        $this->rmFile($sub_file_path, "");
                        rmdir($sub_file_path);
                    }
                    //逐一进行删除
                    unlink($sub_file_path);
                }
                //关闭文件
                closedir($dh);
            }
            rmdir($sub_file_path);//删除当前目录
        }
    }
}

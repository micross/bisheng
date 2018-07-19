<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DividendController extends Controller
{
    public function index(Request $request)
    {
        $config=M('Dividend_config')->select();
        foreach ($config as $k => $v) {
               $list[$v['name']]=$v['value'];
        }
        $currency = M('Currency')->field('currency_id,currency_name')->select();
        $this->assign('config', $list);
        $this->assign('currency', $currency);
        $this->display();
    }
     
   
    public function updateCofig(Request $request)
    {
        foreach ($_POST as $k => $v) {
            $rs[]=M('Dividend_config')->where("name='{$k}'")->setField('value', $v);
        }
        if ($rs) {
            $this->success('配置修改成功');
        } else {
            $this->error('配置修改失败');
        }
    }
}

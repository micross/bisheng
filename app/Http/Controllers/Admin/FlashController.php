<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FlashController extends Controller
{
    public function add(Request $request)
    {
        $flash=M('Flash');
        if (IS_POST) {
            if ($_FILES["Filedata"]["tmp_name"]) {
                $data['pic']=$this->upload($_FILES["Filedata"]);
            }
            if (!empty($_POST['jump_url'])) {
                $data['jump_url']=$_POST['jump_url'];
            }
            if (!empty($_POST['sort'])) {
                $data['sort']=$_POST['sort'];
            }
            if (!empty($_POST['title'])) {
                $data['title']=$_POST['title'];
            }
            $data['add_time']=time();
            if (!empty($_POST['flash_id'])) {
                $data['flash_id']=$_POST['flash_id'];
                $rs=$flash->save($data);
            } else {
                $rs=$flash->add($data);
            }
            if ($rs) {
                $this->success('操作成功');
            } else {
                $this->error('操作失败');
            }
        } else {
            if (!empty($_GET['flash_id'])) {
                $list=$flash->where('flash_id='.$_GET['flash_id'])->find();
                $this->assign('flash', $list);
            }
            $this->display();
        }
    }
    public function index(Request $request)
    {
        $list=M('Flash')->select();
        $this->assign('flash', $list);
        $this->assign('empty', '暂无数据');
        $this->display();
    }
    public function del(Request $request)
    {
        if (!empty($_GET['flash_id'])) {
            $list=M('Flash')->where('flash_id='.$_GET['flash_id'])->delete();
        }
        if ($list) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArttypeController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.arttype.index');
    }
        /**
         * 添加文章分类
         * return id 添加成功信息的id
         */
    public function insert(Request $request)
    {
        $art_cat = M('Article_category');
    
        if (IS_POST) {
            //确定分类别
            $data['parent_id'] = 6;
            //分类名称
            $data['name'] = I('name');
            //关键字
            $data['keywords'] =  I('keyword', '', 'html_entity_decode');
            //排序
            $data['sort'] = I('sort', '', 'html_entity_decode');
                
            //加入数据库
                
            if (I('fenlei_id')) {
                $data['id'] = I('fenlei_id');
                $re = $art_cat->save($data);
            } else {
                $re = $art_cat->add($data);
            }
            if ($re === false) {
                $this->error('操作失败');
                return;
            } else {
                $this->success('操作成功');
                return;
            }
        } else {
            if ($_GET['id']) {
                $id = I('get.id');
                $list = M('Article_category')->where("id = {$id}")->find();
                $this->assign("list", $list);
            }
            //遍历分类（无限级分类）
            $cat = $art_cat->order("id asc")->where('parent_id = 6')->select();//查找1级分类
            //以一级为基础，形成遍历树
        }
            $this->assign('cat', $cat);
            $this->display();
    }

        /**
         * 删除分类
         * return boolen
         */
    public function delete(Request $request)
    {
        $id = $request->get('id');
        $re = ArticleCategory::delete($id);
        if ($re) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}

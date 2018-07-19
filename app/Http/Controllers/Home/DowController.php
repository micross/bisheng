<?php
namespace App\Http\Controllers\Home;

use App\Models\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DowController extends Controller
{
    //虚拟币下载
    public function index(Request $request)
    {
        $list = Currency::get();
        foreach ($list as $k => $v) {
            $list[$k]['guanwang_url'] = trim(trim($v['guanwang_url'], 'https://'), 'http://');
        }

        return view('home.dow.index', $list);
    }

    //浏览器下载
    public function two(Request $request)
    {
        return view('home.dow.two');
    }

    //新币上线
    public function newcoin(Request $request)
    {
        return view('home.dow.newcoin');
    }
}

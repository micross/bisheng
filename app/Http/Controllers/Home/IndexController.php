<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Flash;
use App\Models\Currency;
use App\Models\Trade;
use App\Models\Config;
use App\Models\Link;
use App\Models\Issue;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $info1 = Article::where('article_category.id', 1)->where('article.sign', 0)
        ->join('article_category', 'article.position_id', '=', 'article_category.id')
        ->limit(6)->orderBy('add_time', 'desc')->get();

        $info_red1 = Article::where('article_category.id', 1)->where('article.sign', 1)
        ->join('article_category', 'article.position_id', '=', 'article_category.id')
        ->limit(4)->orderBy('add_time', 'desc')->get();

        $info2 = Article::where('article_category.id', 2)->where('article.sign', 0)
        ->join('article_category', 'article.position_id', '=', 'article_category.id')
        ->limit(6)->orderBy('add_time', 'desc')->get();

        $info_red2 = Article::where('article_category.id', 2)->where('article.sign', 1)
        ->join('article_category', 'article.position_id', '=', 'article_category.id')
        ->limit(4)->orderBy('add_time', 'desc')->get();

        $flash = Flash::orderBy('sort', 'asc')->limit(6)->get();

        $currency = Currency::where('is_line', 1)->orderBy('sort', 'asc')->get()->toArray();
        foreach ($currency as $k => $v) {
            $list = $this->getCurrencyMessageById($v['currency_id']);
            $currency[$k] = array_merge($list, $v);
            $list['new_price'] ? $list['new_price'] : 0;
            $currency[$k]['currency_all_money'] = floatval($v['currency_all_num']) * $list['new_price'];
        }

        //*********选择进盟币,安全可信赖begin*******
        $all_money = Trade::sum('money');
        $config = Config::get();
        foreach ($config as $k => $v) {
            $config[$v['key']] = $v['value'];
        }
        $all_money = $config['transaction_false'] + $all_money;
        $all_money = (string)round($all_money);
        for ($i = 0; $i < strlen($all_money); $i++) {
            $arr[strlen($all_money) - 1 - $i] = $all_money[$i];
        }
        //*********选择进盟币,安全可信赖end*******
        $link_info = Link::get();
        //截断友情链接url头，统一写法
        foreach ($link_info as $k => $v) {
            $url = "";
            $url = trim($v['url'], 'https://');
            $link_info[$k]['url'] = trim($url, 'http://');
        }
        //*******众筹begin*******/////
        $issue_list = Issue::selectRaw("yang_issue.*, yang_currency.currency_name as name")
        ->leftJoin('currency', 'currency.currency_id', '=', 'issue.currency_id')
        ->orderBy('id', 'desc')->get();

        $help = ArticleCategory::where('parent_id', 6)->limit(4)->get();
        $team = Article::where('position_id', 7)->limit(4)->get();

        //*******众筹end*******/////
        $sum_money = $this->numFormat($all_money);
        return view('home.index.index', compact('info1', 'info_red1', 'info2', 'info_red2', 'flash', 'arr', 'issue_list', 'all_money', 'link_info', 'sum_money', 'currency', 'config', 'team', 'help'));
    }


    private function numFormat($num)
    {
        if (!is_numeric($num)) {
            return false;
        }
        $rvalue = '';
        $num = explode('.', $num);//把整数和小数分开
        $rl = !isset($num['1']) ? '' : $num['1'];//小数部分的值
        $j = strlen($num[0]) % 3;//整数有多少位
        $sl = substr($num[0], 0, $j);//前面不满三位的数取出来
        $sr = substr($num[0], $j);//后面的满三位的数取出来
        $i = 0;
        while ($i <= strlen($sr)) {
            $rvalue = $rvalue . ',' . substr($sr, $i, 3);//三位三位取出再合并，按逗号隔开
            $i = $i + 3;
        }
        $rvalue = $sl . $rvalue;
        $rvalue = substr($rvalue, 0, strlen($rvalue) - 1);//去掉最后一个逗号
        $rvalue = explode(',', $rvalue);//分解成数组
        if ($rvalue[0] == 0) {
            array_shift($rvalue);//如果第一个元素为0，删除第一个元素
        }
        $rv = $rvalue[0];//前面不满三位的数
        for ($i = 1; $i < count($rvalue); $i++) {
            $rv = $rv . ',' . $rvalue[$i];
        }
        if (!empty($rl)) {
            $rvalue = $rv . '.' . $rl;//小数不为空，整数和小数合并
        } else {
            $rvalue = $rv;//小数为空，只有整数
        }
        return $rvalue;
    }
}

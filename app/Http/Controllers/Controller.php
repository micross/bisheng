<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Trade;
use App\Models\Order;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getCurrencyMessageById($id)
    {
        $where['currency_id'] = $id;
        $time = time();
        //一天前的时间
        $old_time = strtotime(date('Y-m-d', $time));
        //最新价格
        $order = 'add_time desc';
        $rs = Trade::where('currency_id', $id)->orderBy('add_time', 'desc')->first();
        $data['new_price'] = $rs['price'];
        //判断价格是升是降
        $re = Trade::where('currency_id', $id)->where('add_time', '<', $old_time)->orderBy('add_time', 'desc')->first();
        if ($re['price'] > $rs['price']) {
            //说明价格下降
            $data['new_price_status'] = 0;
        } else {
            $data['new_price_status'] = 1;
        }
        //24H涨跌
        $re = Trade::where('currency_id', $id)->where('add_time', '<', $time - 60 * 60 * 24)->orderBy('add_time', 'desc')->first();
        if ($re['price'] != 0) {
            $data['24H_change'] = sprintf("%.2f", ($rs['price'] - $re['price']) / $re['price'] * 100);
            if ($data['24H_change'] == 0) {
                $data['24H_change'] = 100;
            }
        } else {
            $data['24H_change'] = 100;
        }
        //7D涨跌
        $re = Trade::where('currency_id', $id)->where('add_time', '<', $time - 60 * 60 * 24 * 7)->orderBy('add_time', 'desc')->first();
        if ($re['price'] != 0) {
            $data['7D_change'] = sprintf("%.2f", ($rs['price'] - $re['price']) / $re['price'] * 100);
            if ($data['7D_change'] == 0) {
                $data['7D_change'] = 100;
            }
        } else {
            $data['7D_change'] = 100;
        }
        //24H成交量
        $rs = Trade::select('num')->where('currency_id', $id)->where('add_time', '>', $time - 60 * 60 * 24)->sum('num');
        $data['24H_done_num'] = $rs;
        //24H成交额
        $rs = Trade::select('num', 'price')->where('currency_id', $id)->where('add_time', '>', $time - 60 * 60 * 24)->first();
        $data['24H_done_money'] = $rs['num'] * $rs['price'];
        //最低价
        $data['min_price'] = $this->getminPriceTrade($id);
        //最高价
         $data['max_price'] = $this->getmaxPriceTrade($id);
        //买一价
        $data['buy_one_price'] = $this->getOneOrdersByPrice($id, 'buy');
        //卖一价
        $data['sell_one_price'] = $this->getOneOrdersByPrice($id, 'sell');
        //返回
        return $data;
    }

    protected function getminPriceTrade($currency_id)
    {
         $order = 'asc';
         $trade = $this->getTradeByPrice($currency_id, $order);
         return $trade['price'];
    }

    private function getTradeByPrice($currency_id, $order)
    {
        $where['currency_id'] = $currency_id;
        return Trade::select('price')->where('currency_id', $currency_id)->orderBy('price', $order)->first();
    }

    protected function getMaxPriceTrade($currency_id)
    {
        $order = 'desc';
        $trade = $this->getTradeByPrice($currency_id, $order);
        return $trade['price'];
    }

    protected function getOneOrdersByPrice($currencyid, $type)
    {
        $where['currency_id'] = $currencyid;
        $where['type'] = $type;
        $where['status'] = array('in',array(0,1));
        switch ($type) {
            case 'buy':
                $order = 'desc';
                break;
            case 'sell':
                $order = 'asc';
                break;
        }
         $orders = Order::select('price')->where($where)->orderBy('price', $order)->first();
         return $orders['price'];
    }
}

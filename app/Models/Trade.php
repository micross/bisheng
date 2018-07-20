<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $_auto = array (
        array('status','0'),
        array('add_time','time',1,'function'),
        array('trade_no','setTrade_no',1,'callback'),
    );
    
    //给一个订单号
    public function setTrade_no()
    {
        return 'T'.time();
    }
}
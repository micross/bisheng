<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $table = 'trade';

    //给一个订单号
    public function setTrade_no()
    {
        return 'T'.time();
    }
}

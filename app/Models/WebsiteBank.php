<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteBank extends Model
{

    protected $_validate = array( 
        array('bank_name','require','收款人不能为空'),
        array('bank_adddress','require','开户行不能为空'),

        array('bank_no','require','银行卡账号不能为空'),
    );

    protected $_auto = array(
        array('status',1),
    );
}

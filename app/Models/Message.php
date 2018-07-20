<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $_validate = array(
        array('title','require','标题不能为空',1,'',1),
        array('type','require','类型不能为空',1,'',1),
        array('content','require','内容不能为空',1,'',1),
    );
}

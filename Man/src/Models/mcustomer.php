<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/17
 * Time: 16:44
 */

namespace Man\Models;

use Illuminate\Database\Eloquent\Model;


class MCustomer extends Model
{
    protected $table = 'mcustomer';

    protected $primaryKey = 'CustomerID';

    /**
     * 返回用户信息
     */
    public function User()
    {
        return $this->belongsTo('Man\Models\MUser', 'UserID', 'UserID');
    }
}
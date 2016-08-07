<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/17
 * Time: 16:44
 */

namespace Man\Models;

use Illuminate\Database\Eloquent\Model;


class EOrder extends Model
{
    protected $table = 'eorder';

    protected $primaryKey = 'OrderID';

    /**
     * 获取订单发布者
     */
    public function Customer()
    {
        return $this->belongsTo('Man\Models\MCustomer', 'CustomerID', 'CustomerID');
    }
}
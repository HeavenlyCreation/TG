<?php
/**
 * Created by IntelliJ IDEA.
 * User: Wang
 * Date: 2016/8/9
 * Time: 11:13
 */

namespace Man\Models;

use Illuminate\Database\Eloquent\Model;


class EOrderProduct extends Model
{
    protected $table = 'eorderproduct';

    protected $primaryKey = 'OrderProductID';

    /**
     * 返回产品信息
     */
    public function Product()
    {
        return $this->belongsTo('Man\Models\MProduct', 'ProductID', 'ProductID');
    }

    /**
     * 返回订单信息
     */
//    public function Order()
//    {
//        return $this->belongsTo('Man\Models\EOrder', 'OrderID', 'OrderID');
//    }
}
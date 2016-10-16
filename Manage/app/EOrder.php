<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EOrder extends Model
{
    //
    protected $table = 'EOrder';
    protected $primaryKey = 'OrderID';
    public $timestamps = false;

    /**
     * 获取订单发布者
     */
    public function Customer()
    {
        return $this->belongsTo('App\MLogin', 'LoginID', 'LoginID');
    }

    /**
     * 获取订单产品
     */
    public function OrderProduct()
    {
        return $this->hasMany('App\EOrderProduct', 'OrderID', 'OrderID');
    }

}

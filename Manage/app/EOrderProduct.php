<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EOrderProduct extends Model
{
    //
    protected $table = 'EOrderProduct';
    protected $primaryKey = 'OrderProductID';
    public $timestamps = false;

    /**
     * 返回产品信息
     */
    public function Product()
    {
        return $this->belongsTo('App\MProduct', 'ProductID', 'ProductID');
    }
}

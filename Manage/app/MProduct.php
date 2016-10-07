<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MProduct extends Model
{
    //
    protected $table = 'MProduct';
    protected $primaryKey = 'ProductID';
    public $timestamps = false;

    /**
     * 返回产品类别信息
     */
    public function Category()
    {
        return $this->belongsTo('App\MProductCategory', 'ProductCategoryID', 'ProductCategoryID');
    }
}

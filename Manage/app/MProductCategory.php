<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MProductCategory extends Model
{
    //
    protected $table = 'MProductCategory';
    protected $primaryKey = 'ProductCategoryID';
    public $timestamps = false;

    /**
     * 返回上级类别
     */
    public function FCategory()
    {
        return $this->belongsTo('App\MProductCategory', 'ParentID', 'ProductCategoryID');
    }

}

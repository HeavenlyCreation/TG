<?php
/**
 * Created by IntelliJ IDEA.
 * User: Wang
 * Date: 2016/8/9
 * Time: 11:16
 */

namespace Man\Models;

use Illuminate\Database\Eloquent\Model;


class MProduct extends Model {

    protected $table = 'mproduct';

    protected $primaryKey = 'ProductID';

    /**
     * 返回产品类别信息
     */
    public function Category()
    {
        return $this->belongsTo('Man\Models\MProductCategory', 'ProductCategoryID', 'ProductCategoryID');
    }
}
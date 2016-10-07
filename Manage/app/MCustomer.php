<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MCustomer extends Model
{
    //
    protected $table = 'MCustomer';
    protected $primaryKey = 'CustomerID';
    public $timestamps = false;

    /**
     * 返回用户信息
     */
    public function User()
    {
        return $this->belongsTo('App\MUser', 'UserID', 'UserID');
    }
}

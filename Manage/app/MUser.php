<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MUser extends Model
{
    //
    protected $table = 'MUser';
    protected $primaryKey = 'UserID';
    public $timestamps = false;

    public function Address(){
        return $this->belongsTo('App\MAddress', 'AddressCD', 'AddressCD');
    }

    public function Account(){
        return $this->belongsTo('App\MLogin', 'LoginID', 'LoginID');
    }
}

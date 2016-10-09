<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MWorker extends Model
{
    //
    protected $table = 'MWorker';
    protected $primaryKey = 'WorkerID';
    public $timestamps = false;

    public function User(){
        return $this->belongsTo('App\MUser', 'UserID', 'UserID');
    }

    public function Address(){
        return $this->belongsTo('App\MAddress', 'AddressCD', 'AddressCD');
    }
}

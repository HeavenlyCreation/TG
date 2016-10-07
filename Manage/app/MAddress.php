<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MAddress extends Model
{
    //
    protected $table = 'MAddress';
    protected $primaryKey = 'AddressCD';
    public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EOrder extends Model
{
    //
    protected $table = 'eorder';
    protected $primaryKey = 'OrderID';
    public $timestamps = false;

}

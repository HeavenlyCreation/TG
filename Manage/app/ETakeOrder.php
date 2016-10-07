<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ETakeOrder extends Model
{
    //
    protected $table = 'ETakeOrder';
    protected $primaryKey = 'TakeOrderID';
    public $timestamps = false;
}

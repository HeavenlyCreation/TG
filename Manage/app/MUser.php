<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MUser extends Model
{
    //
    protected $table = 'MUser';
    protected $primaryKey = 'UserID';
    public $timestamps = false;
}

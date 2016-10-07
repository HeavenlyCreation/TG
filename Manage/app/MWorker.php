<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MWorker extends Model
{
    //
    protected $table = 'MWorker';
    protected $primaryKey = 'WorkerID';
    public $timestamps = false;
}

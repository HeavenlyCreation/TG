<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/17
 * Time: 16:44
 */

namespace Man\Models;

use Illuminate\Database\Eloquent\Model;


class MWorker extends Model
{
    protected $table = 'mworker';

    protected $primaryKey = 'MWID';
}
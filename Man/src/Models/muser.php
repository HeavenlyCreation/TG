<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/17
 * Time: 16:44
 */

namespace Man\Models;

use Illuminate\Database\Eloquent\Model;


class MUser extends Model
{
    protected $table = 'muser';

    protected $primaryKey = 'UserID';
}
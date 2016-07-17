<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/17
 * Time: 16:49
 */

namespace Man\Controllers;

use Man\Models\MWorker;


class WorkerController extends BaseController
{
    /**
     * @return mixed
     */
    public function index()
    {
        $worker = MWorker::all();
        return $this->tpl->render('User.index', ['the' => $worker]);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Lib\DT\Paging;
use App\MWorker;

class WorkerController extends Controller
{
    public function ListPage()
    {
        return view('worker.list', ["PageHeader" => "工人信息列表"]);
    }

    public function ListData(Request $request)
    {
        $paging = new Paging();
        $paging->setSelect(" w.WorkerID,w.JobNumber,u.Name,u.Tel,u.Tel2,u.WxCD,ar.AddressName,u.AddressDif,w.WorkStatus ");
        $paging->setFrom(" MWorker w left join MUser u on w.UserId=u.UserId left join MAddress ar on ar.AddressCD=w.AddressCD ");
        $paging->setWhere(" CONCAT_WS(',',w.JobNumber,u.Name) like ? ");
        $paging->setOrder(" u.Name ");
        $paging->setDesc(" asc ");
        $listJSON = $this->GetList($request, $paging);
        return $listJSON;
    }

    public function Detail($workerID){
        $worker = MWorker::where("WorkerID", $workerID)->firstOrFail();
        return view("Worker.Detail",["pageHeader"=>"工人修改", "act"=>"worker", "worker"=>$worker]);
    }
}
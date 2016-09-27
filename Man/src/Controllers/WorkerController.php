<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/17
 * Time: 16:49
 */

namespace Man\Controllers;
use Man\Models\VM\Paging;
use Man\Models\MWorker;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Fluent;
use Illuminate\Database\Capsule\Manager as DB;

class WorkerController extends BaseController
{
    /**
     * @return mixed
     */
    public function Index()
    {
        $wName = isset($_GET['s']) ? htmlentities($_GET['s']) : "";
        $workers = DB::table("MWorker")
            ->leftJoin("MUser","MUser.UserID","=","MWorker.UserID")
            ->select("*")
            ->where("MUser.Name","like","%{$wName}%")
            ->get();
        return $this->tpl->render('Workers/Index.twig', ["PageHeader" => "工人模块","PageDesc"=>"列表"]);
    }

    public function Index2(Request $request){
        $wName = isset($_POST['search']) ? htmlentities($_POST['search']["value"]) : "";
        $paging = new Paging();
        $paging->setSelect(" w.WorkerID,u.LoginID,u.Name,w.JobNumber,w.IdentityNum,u.Age,u.Sex ");
        $paging->setFrom(" MWorker w LEFT JOIN MUser u on w.UserId=u.UserId ");


        $listJson = $this->GetList($request, $paging);
        return $listJson;
    }

    public function Detail(Request $request,$workerID){

        $worker = DB::table("MWorker")
            ->leftJoin("MUser","MUser.UserID","=","MWorker.UserID")
            ->select("*")
            ->where("WorkerID","=", $workerID)
            ->first();
        return $this->tpl->render('Workers/Detail.twig', ["PageHeader"=>"工人详细信息", "Worker"=>$worker]);
    }
}
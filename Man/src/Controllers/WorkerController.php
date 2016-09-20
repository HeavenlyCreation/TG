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
        $wName = isset($_GET['search']) ? htmlentities($_GET['search']["value"]) : "";
        $paging = new Paging();
        $paging->setSelect(" u.LoginID,u.Name,w.JobNumber,w.IdentityNum,u.Age.u.Sex ");
        $paging->setFrom(" FROM MWorker w LEFT JOIN MUser u on w.UserId=u.UserId ");
        $paging->setWhere(" u.Name like '%".$wName."%'");
        $listJson = $this->GetList($request, $paging);
        return $listJson;
    }

    public function Detail(){
        $wId = isset($_GET['wId']) ? htmlentities($_GET['wId']) : "";
        $worker = DB::table("MWorker")
            ->leftJoin("MUser","MUser.UserID","=","MWorker.UserID")
            ->select("*")
            ->where("WorkerID","=", $wId)->first();
        return parent::View('Workers/Detail.twig', ["PageHeader"=>"工人详细信息", "Worker"=>$worker]);
    }
}
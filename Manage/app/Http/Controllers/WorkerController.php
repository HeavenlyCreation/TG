<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Lib\DT\Paging;
use DB;
use App\MUser;
use App\MLogin;
use Crypt;

class WorkerController extends Controller
{
    public function ListPage()
    {
        return view('worker.list', ["PageHeader" => "工人信息列表"]);
    }

    public function ListData(Request $request)
    {
        $paging = new Paging();
        $paging->setSelect(" u.UserID,u.JobNumber,u.Name,u.Tel,u.Tel2,u.WxCD,ar.AddressName,u.AddressDif,c.CodeDesc as WorkStatus ");
        $paging->setFrom(" MUser u 
right join Mlogin l on u.LoginId=l.LoginId AND l.UserTypeCD='ut_Worker'
left join MAddress ar on ar.AddressCD=u.AddressCD
left join mcode c on c.CodeCD=u.WorkStatus");
        $paging->setWhere(" u.Status>-1 AND CONCAT_WS(',',u.JobNumber,u.Name) like ? ");
        $paging->setOrder(" u.Name ");
        $paging->setDesc(" asc ");
        $listJSON = $this->GetList($request, $paging);
        return $listJSON;
    }

    public function Detail($workerID)
    {
        $worker = MUser::where("UserId", $workerID)->firstOrFail();
        return view("Worker.Detail", ["pageHeader" => "工人详情", "act" => "worker", "worker" => $worker]);
    }

    public function Edit($workerID)
    {
        $worker = MUser::where("UserId", $workerID)->firstOrFail();
        return view("Worker.Edit", ["pageHeader" => "工人修改", "act" => "worker", "worker" => $worker, "account" => $worker->Account]);
    }

    public function Add()
    {
        return view("Worker.Edit", ["pageHeader" => "工人添加", "act" => "worker", "worker" => new MUser()]);
    }

    public function SaveData()
    {
        try{
            if(!isset($_POST["workerID"])){
                DB::transaction(function () {
                    $account = MLogin::where("UserName", $_POST["UserName"])->firstOrFail();
                    if ($account != null){
                        return $this->JSONResult(null,"登录账户名已存在","fail");
                    }
                    $LoginID = DB::table('mlogin')->insertGetId(
                        ['UserName' => $_POST["UserName"], 'Password' => bcrypt("123456"), 'UserTypeCD'=>"ut_Worker"]
                    );
                    MUser::insert([
                        'Name' => $_POST["WorkerName"],
                        'JobId' => '',
                        'LoginID' => $LoginID,
                        'JobNumber' => $_POST["JobNumber"],
                        'IdentityNum' =>  $_POST["IdentityNum"],
                        'Tel' => $_POST['Tel'],
                        'Tel2' => $_POST['Tel2'],
                        'WxCD' => $_POST["WxCD"],
                        'AddressDif' => $_POST["Address"],
                        'Status' => 0
                    ]);
                });

            }else{
                $worker = MUser::where("UserId", $_POST["workerID"])->firstOrFail();
                $worker->Name = $_POST["WorkerName"];
                $worker->JobNumber = $_POST["JobNumber"];
                $worker->IdentityNum = $_POST["IdentityNum"];
                $worker->Tel = $_POST["Tel"];
                $worker->Tel2 = $_POST["Tel2"];
                $worker->WxCD = $_POST["WxCD"];
                $worker->AddressDif = $_POST["Address"];
                $worker->save();
            }
        }catch (\Exception $e){
            return $this->JSONResult(null,"修改失败","fail");
        }

        return $this->JSONResult(null,"修改成功");
    }

    public function Del($workerId)
    {
        try {
            $worker = MUser::where("UserId", $workerId)->firstOrFail();
            $worker->Status = -1;
            $worker->save();
        } catch (\Exception $e) {
            return $this->JSONResult(null,"删除失败");
        }
        return $this->JSONResult(null,"删除成功");
    }
}
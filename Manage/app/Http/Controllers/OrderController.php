<?php

namespace App\Http\Controllers;

use App\Http\Lib\Helper\DropHelper;
use App\MUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Lib\DT\Paging;
use App\EOrder;

class OrderController extends Controller
{
    /*
     * 列表页
     */
    public function ListPage(){
        $user = MUser::firstOrFail();
        return view('order.list', ["pageHeader"=>"订单信息列表", "act"=>"order", "user"=>$user]);
    }

    /*
     * 列表页回调函数
     */
    public function ListData(Request $request){
        $paging = new Paging();
        $paging->setSelect(" eorder.OrderID,eorder.OrderNum,muser.Nickname as Customer,eorder.SumPrice,eorder.CommitTime,eorder.BookFitTime,eorder.OrderStatus ");
        $paging->setFrom(" eorder left join mcustomer on eorder.CustomerID=mcustomer.CustomerID left join muser on mcustomer.UserID=muser.UserID ");
        $paging->setWhere(" CONCAT_WS(',',eorder.OrderID,eorder.OrderNum,muser.Nickname,eorder.SumPrice,eorder.CommitTime,eorder.BookFitTime,eorder.OrderStatus) like ? ");
        $paging->setOrder(" eorder.OrderNum ");
        $paging->setDesc(" desc ");
        $listJson = $this->GetList($request, $paging);
        return $listJson;
    }

    /*
     * 详细页
     */
    public function Detail($orderID){
        $order = EOrder::where("OrderID", $orderID)->firstOrFail();
        return view('order.detail', ["pageHeader"=>"订单详细信息", "act"=>"order", "order"=>$order]);
    }

    /*
     * 编辑页
     */
    public function Edit($orderID){
        $order = EOrder::where("OrderID", $orderID)->firstOrFail();
        $drop = new DropHelper();
        $orderStatus = $drop->DropStatus($order->OrderStatus);  // 订单状态下拉框
        $province = $drop->DropAddress($order->AddressCD, 1);  // 地址-省下拉框
        $city = $drop->DropAddress($order->AddressCD, 2);  // 地址-市下拉框
        $district = $drop->DropAddress($order->AddressCD, 3);  // 地址-区下拉框
        return view('order.edit', [
            "pageHeader"=>"订单修改",
            "act"=>"order",
            "order"=>$order,
            "orderStatus"=>$orderStatus,
            "province"=>$province,
            "city"=>$city,
            "district"=>$district
        ]);
    }

    /*
     * 编辑页保存
     */
    public function EditSave(Request $request){
        try{
            EOrder::where("OrderID", $request->get("OrderID"))
                ->update([
//                    'Tel' => $request->get('txtTel'),
                    'SumPrice' => $request->get('txtSumPrice'),
                    'AddressCD' => $request->get('selDistrict'),
                    'AddressDif' => $request->get('txtAddress'),
                    'CommitTime' => $request->get('dateCommitTime')!=""?:Carbon::now(),
                    'BookFitTime' => $request->get('dateBookFitTime')!=""?:Carbon::now(),
                    'FinishTime' => $request->get('dateFinishTime')!=""?:Carbon::now(),
                    'OrderStatus' => $request->get('selOrderStatus'),
                    'Remark' => $request->get('txtRemark')
                ]);
        }catch (\Exception $e){
            return "修改失败";
        }
        return "修改成功";
    }
    
    public function GetAddress(Request $request){
        $drop = new DropHelper();
        $address = $drop->DropAddress($request->AddressCD, $request->level);  // 地址下拉框
        return $address;        
    }
}

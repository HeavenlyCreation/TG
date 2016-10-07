<?php

namespace App\Http\Controllers;

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
        return view('order.list', ["pageHeader"=>"订单信息列表", "act"=>"order"]);
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
        $mv = new Paging();
        return view('order.detail', ["pageHeader"=>"订单详细信息", "act"=>"order", "order"=>$order]);
    }

    /*
     * 编辑页
     */
    public function Edit($orderID){
        $order = EOrder::where("OrderID", $orderID)->firstOrFail();
        $mv = new Paging();
        return view('order.edit', ["pageHeader"=>"订单修改", "act"=>"order", "order"=>$order]);
    }
}

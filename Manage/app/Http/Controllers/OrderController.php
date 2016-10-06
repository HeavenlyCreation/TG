<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{
    /*
     * 列表页
     */
    public function Index(){
        //print_r(self::View());
        return $this->tpl->render('Order/Index.twig', ["PageHeader"=>"订单信息列表", "Act"=>"order"]);
    }

    /*
     * 列表页回调函数
     */
    public function Index2(Request $request){
        $paging = new Paging();
        $paging->setSelect(" eorder.OrderID,eorder.OrderNum,muser.Nickname as Customer,eorder.SumPrice,eorder.CommitTime,eorder.BookFitTime,eorder.OrderStatus ");
        $paging->setFrom(" eorder left join mcustomer on eorder.CustomerID=mcustomer.CustomerID left join muser on mcustomer.UserID=muser.UserID ");
        $paging->setWhere(" CONCAT_WS(',',eorder.OrderID,eorder.OrderNum,muser.Nickname,eorder.SumPrice,eorder.CommitTime,eorder.BookFitTime,eorder.OrderStatus) like ? ");
        $listJson = $this->GetList($request, $paging);
        return $listJson;
    }

    /*
     * 详细页
     */
    public function Detail($orderID){
        $order = EOrder::where("OrderID", $orderID)->firstOrFail();//->attributes();
        $mv = new Paging();
        return $this->tpl->render('Order/Detail.twig', ["PageHeader"=>"订单详细信息", "Act"=>"order", "Order"=>$order]);
    }
}

<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/31
 * Time: 11:13
 */

namespace Man\Controllers;

use Man\Models\VM\Paging;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Fluent;
use Illuminate\Database\Capsule\Manager as DB;

use Man\Models\EOrder;


class OrderController extends BaseController
{
    public function Index(){
        return View();   
//        return $this->tpl->render('Order/Index.twig', ["PageHeader"=>"订单信息列表", "Act"=>"order"]);
    }

    public function Index2(Request $request){
        $paging = new Paging();
        $paging->setSelect(" eorder.OrderID,eorder.OrderNum,muser.Nickname as Customer,eorder.SumPrice,eorder.CommitTime,eorder.BookFitTime,eorder.OrderStatus ");
        $paging->setFrom(" eorder left join mcustomer on eorder.CustomerID=mcustomer.CustomerID left join muser on mcustomer.UserID=muser.UserID ");
        $paging->setWhere(" CONCAT_WS(',',OrderID,OrderNum,CommitTime) like ? ");
        $listJson = $this->GetList($request, $paging);
        return $listJson;
    }

    public function Detail($orderID){
        $order = EOrder::where("OrderID", $orderID)->firstOrFail();//->attributes();
        $mv = new Paging();
        return $this->tpl->render('Order/Detail.twig', ["PageHeader"=>"订单详细信息", "Act"=>"order", "Order"=>$order]);
    }
}
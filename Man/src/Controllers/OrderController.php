<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/31
 * Time: 11:13
 */

namespace Man\Controllers;

use Man\Models\Paging;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Fluent;
use Illuminate\Database\Capsule\Manager as DB;

use Man\Models\EOrder;


class OrderController extends BaseController
{
    public function Index(){
        return $this->tpl->render('Order/Index.twig', ["PageHeader"=>"订单信息列表", "Act"=>"order"]);
    }

    public function Index2(Request $request){
//        $search = $request->get("search")["value"];
//        $sql = " select eorder.OrderID,eorder.OrderNum,muser.Nickname as Customer,eorder.SumPrice,eorder.CommitTime,eorder.BookFitTime,eorder.OrderStatus from eorder join mcustomer on eorder.CustomerID=mcustomer.CustomerID join muser on mcustomer.UserID=muser.UserID ";
//        $par = [];
//        $sort = "";
//        $desc = "";
//        // 搜索条件
//        if(!empty($search)){
//            $sql .= " where CONCAT_WS(',',OrderID,OrderNum,CommitTime) like ? ";
//            $par = ["%".$search."%"];
//            //用模型处理原生SQL
//            //$orders = EOrder::hydrateRaw("select * from eorder where CONCAT_WS(',',OrderID,OrderNum,CommitTime) like ?", ["%".$search."%"])->toArray();
//            //$orders = DB::connection()->select($sql);
//            //$orders = EOrder::all()->toArray();
//        }
//        // 排序
//        if(count($request->get("order"))>0){
//            $sort = $request->get("columns")[$request->get("order")[0]["column"]]["data"];
//            $desc = $request->get("order")[0]["dir"];
//            $sql .= " order by ".$sort." ".$desc;
//        }
//        $orders = DB::connection()->select($sql, $par);
//
//        // 序列化一个包含Array的自定义对象
//        $obj = new Fluent([
//            "draw" => intval($request->get("draw")),
//            "recordsTotal" => intval(EOrder::all()->count()),
//            "recordsFiltered" => intval(count($orders)),
//            "data" => $orders
//        ]);
//        // 转换为Json
//        $listJson = $obj->toJson();
        $paging = new Paging();
        $paging->setSelect(" eorder.OrderID,eorder.OrderNum,muser.Nickname as Customer,eorder.SumPrice,eorder.CommitTime,eorder.BookFitTime,eorder.OrderStatus ");
        $paging->setFrom(" eorder join mcustomer on eorder.CustomerID=mcustomer.CustomerID join muser on mcustomer.UserID=muser.UserID ");
        $paging->setWhere(" CONCAT_WS(',',OrderID,OrderNum,CommitTime) like ? ");
        $listJson = $this->GetList($request, $paging);
        return $listJson;
    }

    public function Detail($orderID){
        $order = EOrder::where("OrderID", $orderID)->first();
        return $this->tpl->render('Order/Detail.twig', ["PageHeader"=>"订单详细信息", "Act"=>"order", "Order"=>$order]);
    }
}
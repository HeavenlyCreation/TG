<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/31
 * Time: 11:13
 */

namespace Man\Controllers;

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
        $search = $request->get("search")["value"];
        if(!empty($search)){
            //用DB处理原生SQL
            //$orders = DB::connection()->select("select * from eorder where CONCAT_WS(',',OrderID,OrderNum,COMMITtime) like ?", ["%".$search."%"]);
            //用模型处理原生SQL
            $orders = EOrder::hydrateRaw("select * from eorder where CONCAT_WS(',',OrderID,OrderNum,CommitTime) like ?", ["%".$search."%"])->toArray();
        }else{
            $orders = EOrder::all()->toArray();
        }

        // 序列化一个包含Array的自定义对象
        $obj = new Fluent([
            "draw" => intval($request->get("draw")),
            "recordsTotal" => intval(EOrder::all()->count()),
            "recordsFiltered" => intval(count($orders)),
            "data" => $orders
        ]);
        // 转换为Json
        $listJson = $obj->toJson();
        return $listJson;
    }

    public function Detail($orderID){
        $order = EOrder::where("OrderID", $orderID)->first();
        return $this->tpl->render('Order/Detail.twig', ["PageHeader"=>"订单详细信息", "Act"=>"order", "Order"=>$order]);
    }
}
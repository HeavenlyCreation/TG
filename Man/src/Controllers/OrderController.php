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
        return $this->tpl->render('Order/Index.twig');
    }

    public function Index2(Request $request){
        $search = $request->get("search")["value"];
        if(!empty($search)){
            $orders = DB::select("select * from eorder where CONCAT(OrderID,OrderNum,COMMITtime) like '%?%'", [$search]);
        }else{
            $orders = EOrder::all();
        }
//        $orders = DB::select("select * from eorder where CONCAT(OrderID,OrderNum,COMMITtime) like '%".$request->get("search")."%'");//->toArray();
        $c = new Fluent([
            "draw" => intval($request->get("draw")),
            "recordsTotal" => intval(2),
            "recordsFiltered" => intval(3),
            "data" => $orders->toArray()
        ]);
        $aa = $c->toJson();
        return $aa;
    }
}
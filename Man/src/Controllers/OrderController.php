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

use Man\Models\EOrder;


class OrderController extends BaseController
{
    public function Index(){
        return $this->tpl->render('Order/Index.twig');
    }

    public function Index2(Request $request){
        $orders = EOrder::all()->toArray();
        $c = new Fluent([
            "draw" => intval($request->get("draw")),
            "recordsTotal" => intval(2),
            "recordsFiltered" => intval(3),
            "data" => $orders
        ]);
        $aa = $c->toJson();
        return $aa;
    }
}
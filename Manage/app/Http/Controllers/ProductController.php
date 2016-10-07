<?php

namespace App\Http\Controllers;

use App\MProduct;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProductController extends Controller
{
    /*
     * 列表页
     */
    public function ListPage(){
        return view('product.list', ["pageHeader"=>"服务信息列表", "act"=>"product"]);
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
    public function Detail($productID){
        $product = MProduct::where("ProductID", $productID)->firstOrFail();
        return view('product.detail', ["pageHeader"=>"服务详细信息", "act"=>"product", "product"=>$product]);
    }
}

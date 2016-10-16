<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Lib\DT\Paging;
use App\MProduct;
use App\Http\Requests;
use App\Http\Lib\Helper\DropHelper;

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
        $paging->setSelect(" mproduct.ProductID,mproductcategory.CategoryName,mproduct.ProductName,mproduct.Price,mproduct.CreatedTime ");
        $paging->setFrom(" mproduct left join mproductcategory on mproduct.ProductCategoryID=mproductcategory.ProductCategoryID ");
        $paging->setWhere(" CONCAT_WS(',',mproduct.ProductID,mproductcategory.CategoryName,mproduct.ProductName,mproduct.Price,mproduct.CreatedTime) like ? ");
        $paging->setOrder(" mproduct.ProductID ");
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

    /*
     * 编辑页
     */
    public function Edit($productID){
        $product = MProduct::where("ProductID", $productID)->firstOrFail();
        $drop = new DropHelper();
        $categorys = $drop->DropCategory($product->ProductID);
        return view('product.edit', ["pageHeader"=>"服务详细信息", "act"=>"product", "product"=>$product, "categorys"=>$categorys]);
    }

    /*
     * 编辑页保存
     */
    public function EditSave(Request $request){
        try{
            MProduct::where("ProductID", $request->get("ProductID"))
                ->update([
                    'ProductName' => $request->get('txtProductName'),
                    'ProductCategoryID' => $request->get('selCategorys'),
                    'Price' => $request->get('txtPrice'),
                    'Remark' => $request->get('txtRemark'),
                    'CreatedTime' => $request->get('dateCreatedTime')??Carbon::now()
                ]);
        }catch (\Exception $e){
            return "修改失败";
        }
        return "修改成功";
    }
}

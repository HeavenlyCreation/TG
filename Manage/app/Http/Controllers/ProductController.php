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
        $IsNew = empty($request->get("ProductID"));
        try{
            if ($IsNew){
                MProduct::insert([
                    'ProductName' => $request->get('txtProductName'),
                    'ProductCategoryID' => intval($request->get('selCategorys')),
                    'Price' => doubleval($request->get('txtPrice')),
                    'Remark' => $request->get('txtRemark'),
                    'CreatedTime' => Carbon::now()
                ]);
            }else{
                MProduct::where("ProductID", $request->get("ProductID"))
                    ->update([
                        'ProductName' => $request->get('txtProductName'),
                        'ProductCategoryID' => $request->get('selCategorys'),
                        'Price' => $request->get('txtPrice'),
                        'Remark' => $request->get('txtRemark'),
                        'CreatedTime' => Carbon::now()
                    ]);
            }
        }catch (\Exception $e){
            return $this->JSONResult(null,$IsNew ? "添加失败" : "修改失败","fail");
        }
        return $this->JSONResult(null,$IsNew ? "添加成功" : "修改成功");
    }

    public function Add(){
        $product = new MProduct();
        $drop = new DropHelper();
        $categorys = $drop->DropCategory("");
        return view('product.edit', ["pageHeader"=>"服务详细信息", "act"=>"product", "product"=>$product, "categorys"=>$categorys]);
    }

    public function Del($productId){
        try{
            $productId = MProduct::where("OrderId", $productId)->firstOrFail();
            $productId->Status = -1;
            $productId->save();
        }catch (\Exception $e){
            return $this->JSONResult(null,"删除失败","fail");
        }
        return $this->JSONResult(null,"删除成功");
    }
}

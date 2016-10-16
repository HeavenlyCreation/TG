<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use App\Http\Requests;
use App\MProductCategory;
use App\Http\Lib\DT\Paging;
use App\Http\Lib\Helper\DropHelper;

class ProductCategoryController extends Controller
{
    /*
     * 列表页
     */
    public function ListPage(){
        return view('category.list', ["pageHeader"=>"服务类别列表", "act"=>"product"]);
    }

    /*
     * 列表页回调函数
     */
    public function ListData(Request $request){
        $paging = new Paging();
        $paging->setSelect(" pc1.ProductCategoryID,pc1.CategoryName,pc2.CategoryName as FCategoryName ");
        $paging->setFrom(" mproductcategory pc1 left join mproductcategory pc2 on pc1.ParentID=pc2.ProductCategoryID ");
        $paging->setWhere(" CONCAT_WS(',',pc1.CategoryName,pc2.CategoryName) like ? ");
        $paging->setOrder(" pc1.ParentID,pc1.ProductCategoryID ");
        $paging->setDesc(" asc ");
        $listJson = $this->GetList($request, $paging);
        return $listJson;
    }

    /*
     * 详细页
     */
    public function Detail($productCategoryID){
        $productCategory = MProductCategory::where("ProductCategoryID", $productCategoryID)->firstOrFail();
        return view('category.detail', ["pageHeader"=>"服务类别详细信息", "act"=>"product", "category"=>$productCategory]);
    }

    /*
     * 编辑页
     */
    public function Edit($productCategoryID){
        $productCategory = MProductCategory::where("ProductCategoryID", $productCategoryID)->firstOrFail();
        $drop = new DropHelper();
        $categorys = $drop->DropCategory($productCategory->ParentID);
        return view('category.edit', ["pageHeader"=>"服务类别详细信息", "act"=>"product", "category"=>$productCategory, "categorys"=>$categorys]);
    }

    /*
     * 编辑页保存
     */
    public function EditSave(Request $request){
        try{
            MProductCategory::where("ProductCategoryID", $request->get("productCategoryID"))
                ->update([
                    'CategoryName' => $request->get('txtCategoryName'),
                    'ParentID' => $request->get('selCategorys'),
                    'CreatedTime' => $request->get('dateCreatedTime')
                ]);
        }catch (\Exception $e){
            return "修改失败";
        }
        return "修改成功";
    }
}

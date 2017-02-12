<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\MProductCategory;
use App\Http\Lib\DT\Paging;
use App\Http\Lib\Helper\DropHelper;
use Carbon\Carbon;

class ProductCategoryController extends Controller
{
    /*
     * 列表页
     */
    public function ListPage()
    {
        return view('category.list', ["pageHeader" => "服务类别列表", "act" => "product"]);
    }

    /*
     * 列表页回调函数
     */
    public function ListData(Request $request)
    {
        $paging = new Paging();
        $paging->setSelect(" pc1.ProductCategoryID,pc1.CategoryName,pc1.ParentID,pc2.CategoryName as FCategoryName ");
        $paging->setFrom(" mproductcategory pc1 left join mproductcategory pc2 on pc1.ParentID=pc2.ProductCategoryID ");
        $paging->setWhere(" pc1.Status>-1 AND CONCAT_WS(',',pc1.CategoryName,pc2.CategoryName) like ? ");
        $paging->setOrder(" pc1.ParentID,pc1.ProductCategoryID ");
        $paging->setDesc(" asc ");
        $listJson = $this->GetList($request, $paging);
        return $listJson;
    }

    /*
     * 详细页
     */
    public function Detail($productCategoryID)
    {
        $productCategory = MProductCategory::where("ProductCategoryID", $productCategoryID)->firstOrFail();
        return view('category.detail', ["pageHeader" => "服务类别详细信息", "act" => "product", "category" => $productCategory]);
    }

    /*
     * 编辑页
     */
    public function Edit($productCategoryID)
    {
        $productCategory = MProductCategory::where("ProductCategoryID", $productCategoryID)->firstOrFail();
        $drop = new DropHelper();
        $categorys = $drop->DropCategory($productCategory->ParentID);
        return view('category.edit', ["pageHeader" => "服务类别详细信息", "act" => "product", "category" => $productCategory, "categorys" => $categorys]);
    }

    /*
     * 新增页
     */
    public function Add()
    {
        $drop = new DropHelper();
        $categorys = $drop->DropCategory("");
        return view('category.edit', ["pageHeader" => "服务类别详细信息", "act" => "product", "category" => new MProductCategory(), "categorys" => $categorys]);
    }

    public function Del($productCategoryID)
    {
        try {
            DB::update('UPDATE MProductCategory SET Status=-1 WHERE ProductCategoryID=? OR ParentID=?', [$productCategoryID, $productCategoryID]);
        } catch (\Exception $e) {
            return $this->JSONResult(null, "删除失败");
        }
        return $this->JSONResult(null, "删除成功");
    }

    /*
     * 编辑页保存
     */
    public function EditSave(Request $request)
    {
        $IsNew = empty($request->get("productCategoryID"));
        try {
            if ($IsNew) {
                MProductCategory::insert([
                    'CategoryName' => $request->get('txtCategoryName'),
                    'ParentID' => empty($request->get('selCategorys')) ? null : $request->get('selCategorys'),
                    'CreatedTime' => Carbon::now()
                ]);
            } else {
                MProductCategory::where("ProductCategoryID", $request->get("productCategoryID"))
                    ->update([
                        'CategoryName' => $request->get('txtCategoryName'),
                        'ParentID' => empty($request->get('selCategorys')) ? null : $request->get('selCategorys'),
                        'CreatedTime' => Carbon::now()
                    ]);
            }
        } catch (\Exception $e) {
            return $this->JSONResult(null, $IsNew ? "添加成功" : "修改成功");
        }
        return $this->JSONResult(null, $IsNew ? "添加失败" : "修改失败", "fail");
    }
}

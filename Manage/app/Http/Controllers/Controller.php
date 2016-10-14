<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use APP\Http\Lib\DT\Paging;
use Illuminate\Support\Fluent;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
        $this->middleware('auth:web');
    }

    /**
     * 数据列表数据获取
     * @param Request $request
     * @param Paging $paging
     * @return string
     */
    public function GetList(Request $request, Paging $paging){
        $search = $request->get("search")["value"]; // 搜索输入值
        $args = [];  //Sql参数
        // 显示的合计条数
        $sqls = "select count(1) as Total from ".$paging->getFrom()." where 1=1 ";
        $count = DB::connection()->select($sqls)[0]->Total;
        $sqls = "select ".$paging->getSelect()." from ".$paging->getFrom()." where 1=1 ";
        // 搜索
        if(!empty($search)){
            $sqls .= " and ".$paging->getWhere();
            $args = ["%".$search."%"];
        }
        // 排序
        if(empty($paging->getOrder()) || $request->get("order")[0]["column"]>0){
            $sort = $request->get("columns")[$request->get("order")[0]["column"]]["data"];
            $desc = $request->get("order")[0]["dir"];
            $sqls .= " order by ".$sort." ".$desc;
        }else{
            $sqls .= " order by ".$paging->getOrder()." ".(empty($paging->getDesc()) ? $paging->getDesc() : "");
        }
        // 按显示条数limit
        $sqls .= " limit ".$request->get("start").",".$request->get("length");
        $list = DB::connection()->select($sqls, $args);
        // 序列化一个包含Array的自定义对象
        $obj = new Fluent([
            "draw" => intval($request->get("draw")),
            "recordsTotal" => intval($count),
            "recordsFiltered" => intval($count),
            "data" => $list
        ]);
        // 转换为Json
        return $obj->toJson();
    }
}

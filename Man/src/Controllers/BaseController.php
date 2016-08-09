<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/16
 * Time: 23:39
 */

namespace Man\Controllers;

use Man\Models\Paging;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\HttpFoundation\Request;

class BaseController
{
    // twig 实例
    public $tpl;
    //
    public $assets;

    public function __construct(){
        // twig 模板引擎设置
        $loader = new \Twig_Loader_Filesystem(BASEDIR.'/src/Views');
        $this->tpl = new \Twig_Environment($loader, array(
            'debug' => true,
//            'cache' => BASEDIR.'/storage/viewcache',
        ));
        $this->tpl->addExtension(new \Twig_Extension_Debug());
        
    }
    
    public function View($file, $var){
        return $this->tpl->render($file, $var);
    }

    public function GetList(Request $request, Paging $paging, $args){
        $search = $request->get("search")["value"]; // 搜索输入值
        $par = [];  //Sql参数
        $sort = ""; //排序字段
        $desc = ""; //正序还是倒序
        // 搜索条件
        if(!empty($search)){
            $sqls["select"] .= " where ";
            $par = ["%".$search."%"];
        }
        // 排序
        if(count($request->get("order"))>0){
            $sort = $request->get("columns")[$request->get("order")[0]["column"]]["data"];
            $desc = $request->get("order")[0]["dir"];
            $sql .= " order by ".$sort." ".$desc;
        }


        $sql = "select ".$paging->getSelect()." from ".$paging->getFrom();
        // 搜索
        if(!empty($search)){
            $sql .= " where ".$paging->getWhere();
            $par = $args;
        }
        // 排序
        if(count($request->get("order"))>0){
            $sort = $request->get("columns")[$request->get("order")[0]["column"]]["data"];
            $desc = $request->get("order")[0]["dir"];
            $sql .= " order by ".$sort." ".$desc;
        }
        $orders = DB::connection()->select($sql, $par);

        // 序列化一个包含Array的自定义对象
        $obj = new Fluent([
            "draw" => intval($request->get("draw")),
            "recordsTotal" => intval(EOrder::all()->count()),
            "recordsFiltered" => intval(count($orders)),
            "data" => $orders
        ]);
        // 转换为Json
        $listJson = $obj->toJson();
    }

}
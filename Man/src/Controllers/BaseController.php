<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/16
 * Time: 23:39
 */

namespace Man\Controllers;

use Illuminate\Support\Fluent;
use Man\Models\VM\Paging;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Capsule\Manager as DB;

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
            'strict_variables' => false
//            'cache' => BASEDIR.'/storage/viewcache',
        ));
        $this->tpl->addExtension(new \Twig_Extension_Debug());
        
    }
    
    public function View($file, $var){
        return $this->tpl->render($file, $var);
    }

    public function GetList(Request $request, Paging $paging){
        $search = $request->get("search")["value"]; // 搜索输入值
        $par = [];  //Sql参数
        $sqls = "select ".$paging->getSelect()." from ".$paging->getFrom()." where 1=1 ";
        $cut = count(DB::connection()->select($sqls));
        // 搜索
        if(!empty($search)){
            $sqls .= " and ".$paging->getWhere();
            $par = ["%".$search."%"];
        }
        // 排序
        if(count($request->get("order"))>0){
            $sort = $request->get("columns")[$request->get("order")[0]["column"]]["data"];
            $desc = $request->get("order")[0]["dir"];
            $sqls .= " order by ".$sort." ".$desc;
        }
        $orders = DB::connection()->select($sqls, $par);

        // 序列化一个包含Array的自定义对象
        $obj = new Fluent([
            "draw" => intval($request->get("draw")),
            "recordsTotal" => intval($cut),
            "recordsFiltered" => intval(count($orders)),
            "data" => $orders
        ]);
        // 转换为Json
        return $obj->toJson();
    }

}
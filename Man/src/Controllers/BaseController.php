<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/16
 * Time: 23:39
 */

namespace Man\Controllers;

use Illuminate\Support\Fluent;
use Lib\Core\Config;
use Man\Models\VM\Paging;
use Symfony\Component\Asset\PathPackage;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Capsule\Manager as DB;

class BaseController
{
    use \Lib\Core\View;
    
    // twig 实例
    public $tpl;
    // 模板文件中的变量
    public $args = [];

    public function __construct(){
        $this->TwigLoad();
    }

    /**
     * 加载Twig
     */
    private function TwigLoad(){
        // twig 模板引擎设置
        $loader = new \Twig_Loader_Filesystem(Config::get('path', 'view'));
        $this->tpl = new \Twig_Environment($loader, array(
            'debug' => true,
            'strict_variables' => false
            // 'cache' => BASEDIR.'/storage/viewcache',
        ));
        $this->tpl->addExtension(new \Twig_Extension_Debug());
    }

    /**
     * 显示模板文件
     * @param $file 模板文件名称, 以'.'分割命名空间
     * @param $var  数组，传递给模板的数组
     * @return mixed
     */
    public function View($file=null, $var=null){ //return debug_backtrace();
        if(!isset($file)) {
            // TODO 添加根据类、方法找到模板文件
            $func = debug_backtrace()[1]['function'];
        }else{
            $path = Config::get('path', 'view');
            $file = $path.str_replace('.', DIRECTORY_SEPARATOR, $file).Config::get('app', 'TwigFileExt');
        }
        if(is_file($file))
            return $this->tpl->render($file, $var);
        else
            return '404';
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
        $sqls = "select count(1) from ".$paging->getFrom()." where 1=1 ";
        $cut = DB::connection()->select($sqls);

        $sqls = "select ".$paging->getSelect()." from ".$paging->getFrom()." where 1=1 ";
        // 搜索
        if(!empty($search)){
            $sqls .= " and ".$paging->getWhere();
            $args = ["%".$search."%"];
        }
        // 排序
        if(count($request->get("order"))>0){
            $sort = $request->get("columns")[$request->get("order")[0]["column"]]["data"];
            $desc = $request->get("order")[0]["dir"];
            $sqls .= " order by ".$sort." ".$desc;
        }
        $list = DB::connection()->select($sqls, $args);

        // 序列化一个包含Array的自定义对象
        $obj = new Fluent([
            "draw" => intval($request->get("draw")),
            "recordsTotal" => intval($cut),
            "recordsFiltered" => intval(count($list)),
            "data" => $list
        ]);
        // 转换为Json
        return $obj->toJson();
    }

}
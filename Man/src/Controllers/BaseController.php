<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/16
 * Time: 23:39
 */

namespace Man\Controllers;

use Symfony\Component\Asset\PathPackage;

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
//            'cache' => BASEDIR.'/storage/viewcache',
        ));
        
    }
    
    public function View($file, $var){
        return $this->tpl->render($file, $var);
    }

}
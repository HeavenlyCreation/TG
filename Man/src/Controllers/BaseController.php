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
    public $tpl;
    public $assets;

    public function __construct()
    {
        // twig 模板引擎设置
        $loader = new \Twig_Loader_Filesystem(__DIR__.'/../Views');
        $this->tpl = new \Twig_Environment($loader, array(
            'cache' => BASEDIR.'/storage/tplcache',
        ));
    }

}
<?php
/**
 * Created by IntelliJ IDEA.
 * User: Wang
 * Date: 2016/8/23
 * Time: 13:44
 */
return [
    // 系统的存储路径，如cache、log
    'storage'   =>  BASEDIR.'storage'.DIRECTORY_SEPARATOR,

    // view cache
    'viewcache' =>  BASEDIR.'storage'.DIRECTORY_SEPARATOR.'viewcache'.DIRECTORY_SEPARATOR,

    // log
    'log'       =>  BASEDIR.'storage'.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR,
    
    // MVC    
    // View
    'view'      =>  BASEDIR.'src'.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR,
    // View
    'model'      =>  BASEDIR.'src'.DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR,
    // View
    'controller'      =>  BASEDIR.'src'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR,
];

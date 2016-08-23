<?php
/**
 * Created by IntelliJ IDEA.
 * User: Wang
 * Date: 2016/8/23
 * Time: 17:13
 */

namespace Lib\Core;


class Log {
    static $class;
    
    public static function init(){
        $driver = Config::get('log', 'DRIVER');
        $class = '\Lib\Log\\'.$driver;
        self::$class = new $class;
    }
    
    public static function log($msg, $name){
        self::$class->log($msg, $name);
    }
}
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

    /**
     * 初始化具体日志类
     */
    public static function init(){
        $driver = Config::get('log', 'DRIVER');
        $class = 'Lib\Log\\'.$driver;
        self::$class = new $class;
    }

    /**
     * 调用具体日志类
     * @param $msg
     * @param $name
     */
    public static function log($msg, $name='log'){
        self::$class->log($msg, $name);
    }
}
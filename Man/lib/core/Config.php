<?php
/**
 * Author: WangJbo
 * 配置加载类
 */

namespace Lib\Core;

class Config{

    public static $class;
    public static $conf = [];
    public static $break = '.';

    public static function init(){
        if(!is_dir(CONFDIR)){
            return null;
        }
        if(self::get('app', 'BREAK')){
            self::$conf['app'] = self::all('app');
            self::$break = self::$conf['app']['BREAK'];
        }
        self::$class = new Config();
        return self::$class;
    }

    /**
     * 得到配置文件中的键对应的值
     * @param $file 不包括路径、扩展名的文件名，如database.php,$file
     * @param $key 要查找的配置文件中的键
     * @return mixed|null
     */
    public static function get($file, $key){
        $path = CONFDIR.$file.'.php';
        if(isset(self::$conf[$path]))
            return self::forKeys(self::$conf[$path], $key);
        if(is_file($path)){
            $config = require_once($path);
            $confTemp = self::forKeys($config, $key);

            if(isset($confTemp)){
                self::$conf[$path] = $config;
                return $confTemp;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    /**
     * 得到配置文件的大数组
     * @param $file
     * @return array
     * @throws \Exception
     */
    public static function all($file){
        $path = CONFDIR.$file.'.php';
        if(isset(self::$conf[$path]))
            return self::$conf[$path];
        if(is_file($path)){
            $conf = require_once($path);
            self::$conf[$path] = $conf;
            return self::$conf;
        }else{
            return null;
        }
    }

    /**
     * 将带$break的字符串转为多维数组对应的键
     * @param $ary
     * @param $str
     * @return mixed
     */
    private static function forKeys($ary, $str){
        $str = trim($str, self::$break);
        $keys = explode(self::$break, $str);
        $ay = $ary[$keys[0]];
        if(strpos($str, self::$break)!=false){
            $keys = substr($str, strlen($keys[0])+1, strlen($str));
            return self::forKeys($ay, $keys);
        }else{
            return $ay;
        }
    }
}
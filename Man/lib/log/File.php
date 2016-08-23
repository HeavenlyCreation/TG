<?php

/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/8/23
 * Time: 23:08
 */

namespace Lib\Log;

use Lib\Core\Config;

class File
{
    private $path;
    public function __construct(){
        $this->path = Config::get('log', 'File.PATH');
    }

    public function log($msg, $name='log'){
        if(is_dir($this->path)){
            $curUTime = time();
            $path = $this->path.DIRECTORY_SEPARATOR.getdate($curUTime)->year;
            $file = $path.DIRECTORY_SEPARATOR.date('Y-m-d', $curUTime).'.'.$name.'.txt';
            if(!is_dir($path)){
                mkdir($path, '0777');
            }
            file_put_contents($file, $msg.PHP_EOL, FILE_APPEND);
        }else{
            throw new \Exception('日志目录不存在');
        }
    }
}
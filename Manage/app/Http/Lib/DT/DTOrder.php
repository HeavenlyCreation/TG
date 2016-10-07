<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/10/6
 * Time: 14:34
 */

namespace APP\Http\Lib\DT;


class DTOrder
{
    /**
     * 排序的列的索引
     */
    public $column;

    /**
     * 排序模式
     */
    public DataTablesOrderDir $dir;

}
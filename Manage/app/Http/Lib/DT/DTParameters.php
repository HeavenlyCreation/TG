<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/10/6
 * Time: 13:29
 */

namespace APP\Http\Lib\DT;


class DTParameters
{
    public $draw;

    /**
     * 第一条数据的起始位置
     */
    public $start;

    /**
     * 每页显示的数据条数
     */
    public $length;
    
    /**
     * 数据列-List<DataTablesColumns>
     */
    public $columns;

    /**
     * 排序-List<DataTablesOrder>
     */
    public $order;

    /**
     * 搜索
     */
    public DTSearch $search;

    /**
     * 排序字段
     */
    public $orderBy;

    /**
     * 排序模式
     */
    public DTOrderDir $orderDir;
}
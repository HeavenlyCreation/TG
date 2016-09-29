<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/9/29
 * Time: 22:35
 */

namespace Man\Models\Tabler;


class DtSearch
{
    public $value;
    public $regex;

    /**
     * 全局的搜索条件的值
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * 是否为正则表达式处理
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getRegex()
    {
        return $this->regex;
    }

    /**
     * @param mixed $regex
     */
    public function setRegex($regex)
    {
        $this->regex = $regex;
    }
}
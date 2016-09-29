<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/9/29
 * Time: 22:40
 */

namespace Man\Models\Tabler;


class DtColumns
{
    public $data;
    public $name;
    public $searchable;
    public $orderable;
    public $search;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSearchable()
    {
        return $this->searchable;
    }

    /**
     * @param mixed $searchable
     */
    public function setSearchable($searchable)
    {
        $this->searchable = $searchable;
    }

    /**
     * @return mixed
     */
    public function getOrderable()
    {
        return $this->orderable;
    }

    /**
     * @param mixed $orderable
     */
    public function setOrderable($orderable)
    {
        $this->orderable = $orderable;
    }

    /**
     * @return mixed
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @param mixed $search
     */
    public function setSearch(DtSearch $search)
    {
        $this->search = $search;
    }
}
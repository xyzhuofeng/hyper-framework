<?php

/**
 * 分页类
 * Class Paginator
 * 实现迭代器接口
 */
class Paginator implements Iterator
{
    /**
     * 数据集
     * @var array
     */
    private $data = [];

    /**
     * 数据集数组下标
     * @var int
     */
    private $position = 0;

    /**
     * 每页显示条数
     * @var int
     */
    private $max_perpage = 0;

    /**
     * 总记录数
     * @var int
     */
    private $total;

    public function __construct(int $max_perpage, int $total, array $data)
    {
        $this->max_perpage = $max_perpage;
        $this->total = $total;
        $this->data = $data;
    }

    /**
     * 设置数据集
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function isEmpty(){
        return empty($this->data);
    }

    /**
     * 渲染分页条
     */
    public function render(){
        return "这是分页条";
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->data[$this->position];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return isset($this->data[$this->position]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->position = 0;
    }
}
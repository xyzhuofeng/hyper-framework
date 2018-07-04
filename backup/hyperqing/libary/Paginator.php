<?php

namespace hyper;

/**
 * 分页类
 * @author HyperQing
 * 实现迭代器接口
 */
class Paginator implements \Iterator, \ArrayAccess
{
    /**
     * @var array 数据集
     */
    private $data = [];

    /**
     * 数据集数组下标
     * @var int
     */
    private $position = 0;

    /**
     * @var int 每页显示条数
     */
    private $max_perpage = 0;

    /**
     * @var int 总记录数
     */
    private $total_count;

    /**
     * @var int 总页数
     */
    private $total_page;

    /**
     * @var int 当前页码
     */
    private $page;


    public function __construct(int $max_perpage, int $total_count, array $data, $page)
    {
        $this->page = $page;
        $this->max_perpage = $max_perpage;
        $this->data = $data;
        $this->total_count = $total_count;
        $this->total_page = (int)ceil($total_count / $max_perpage);
    }

    /**
     * 设置数据集
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function isEmpty()
    {
        return empty($this->data);
    }

    /**
     * 渲染分页条
     */
    public function render()
    {
        $str = '<nav aria-label="Page navigation">';
        $str .= '<ul class="pagination">';
        $str .= '<li><a href="#">共 ' . $this->total_count . ' 条</a></li>';
        // 上一页按钮
        $css = '';
        $url = '#';
        // 已经是第一页自然就没有上一页
        if ($this->page <= 1) {
            $css = 'class="disabled"';
        } else {
            $url = './index2.php?page=' . ($this->page - 1);
        }
        $t = '';
        $t .= <<<STR
          <li {$css}>
            <a href="{$url}" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
STR;
        $str .= $t;
        // 页码
        for ($i = 1; $i <= $this->total_page; $i++) {
            if ($i == $this->page) {
                $str .= '<li class="active"><a href="#">' . $i . '</a></li>';
            } else {
                $str .= '<li><a href="./index2.php?page=' . $i . '">' . $i . '</a></li>';
            }
        }
        // 下一页按钮
        $css = '';
        $url = '#';
        // 已经是最后一页自然就没有下一页
        if ($this->page >= $this->total_page) {
            $css = 'class="disabled"';
        } else {
            $url = './index2.php?page=' . ($this->page + 1);
        }
        $t = '';
        $t .= <<<STR
          <li {$css}>
            <a href="{$url}" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
STR;
        $str .= $t;
        $str .= '</ul>';
        $str .= '</nav>';
        return $str;
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

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        if (isset($this->data[$offset])) {
            return true;
        }
        return false;
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }
}

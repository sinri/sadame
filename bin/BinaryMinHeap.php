<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/13
 * Time: 14:14
 */

namespace sinri\sadame\bin;


use sinri\sadame\interfaces\Heap;

class BinaryMinHeap implements Heap
{
    protected $stock = [];

    public function __construct()
    {
        $this->stock = [];
    }

    /**
     * build    创建一个空堆    O(n)
     */
    public function reset()
    {
        $this->stock = [];
    }

    /**
     * insert    向堆中插入一个新元素    {\displaystyle O(\log n)} O(\log n)
     */
    public function insert($object)
    {
        $this->stock[] = $object;
        $this->update();
    }

    /**
     * update    将新元素提升使其匹配堆的性质
     */
    public function update()
    {
        $last_index = count($this->stock) - 1;

        $ptr = $last_index;
        while ($ptr > 0) {
            $parent_index = $this->getParentIndex($ptr);
            if ($this->stock[$ptr] >= $this->stock[$parent_index]) {
                break;
            }
            //swap if parent>child as min heap
            $this->swapHeapNodes($ptr, $parent_index);
            $ptr = $parent_index;
        }
    }

    /**
     * get    获取当前堆顶元素的值    O(1)
     */
    public function getTop()
    {
        return isset($this->stock[0]) ? $this->stock[0] : null;
    }

    /**
     * delete    删除堆顶元素    {\displaystyle O(\log n)} O(\log n)
     */
    public function deleteTop()
    {
        $top = $this->stock[0];
        $this->stock[0] = null;
        if ($this->getTailIndex() === 0) {
            $this->reset();
        } else {
            $this->reorganizeAsHeap();
        }
    }

    /**
     * reorganizeAsHeap    使删除堆顶元素的堆再次成为堆
     */
    public function reorganizeAsHeap()
    {
        $this->stock[0] = $this->getTail();
        unset($this->stock[$this->getTailIndex()]);

        $ptr = 0;
        while ($this->hasChild($ptr)) {
//            echo "reorganizeAsHeap in while: ptr=".$ptr."(".$this->stock[$ptr]."),";
//            echo " left child=".$this->getLeftChild($ptr).",";
//            echo " right child=".$this->getRightChild($ptr).PHP_EOL;
            if ($this->stock[$ptr] <= $this->getLeftChild($ptr) && $this->stock[$ptr] <= $this->getRightChild($ptr)) {
                echo "ORDER GOOD" . PHP_EOL;
                break;
            }
            if ($this->getLeftChild($ptr) <= $this->getRightChild($ptr)) {
                $this->swapHeapNodes($this->getLeftChildIndex($ptr), $ptr);
                $ptr = $this->getLeftChildIndex($ptr);
//                echo "SWAPPED WITH LEFT".PHP_EOL;
            } else {
                $this->swapHeapNodes($this->getRightChildIndex($ptr), $ptr);
                $ptr = $this->getRightChildIndex($ptr);
//                echo "SWAPPED WITH RIGHT".PHP_EOL;
            }
        }
    }

    // self use
    public function getTailIndex()
    {
        if (empty($this->stock)) return -1;
        return count($this->stock) - 1;
    }

    public function getTail()
    {
        $last_index = $this->getTailIndex();
        if ($last_index < 0 || !isset($this->stock[$last_index])) return null;
        return $this->stock[$last_index];
    }

    public function getParentIndex($index)
    {
        $parent_index = intval(floor(($index - 1) / 2), 10);
        return $parent_index;
    }

    public function swapHeapNodes($index1, $index2)
    {
        $tmp = $this->stock[$index1];
        $this->stock[$index1] = $this->stock[$index2];
        $this->stock[$index2] = $tmp;
    }

    public function hasChild($index)
    {
        $child_index = $index * 2 + 1;
        return ($this->getTailIndex() >= $child_index);
    }

    public function getLeftChildIndex($index)
    {
        return $index * 2 + 1;
    }

    public function getRightChildIndex($index)
    {
        return $index * 2 + 2;
    }

    public function getLeftChild($index)
    {
        $child_index = $index * 2 + 1;
        return ($this->getTailIndex() >= $child_index ? $this->stock[$child_index] : null);
    }

    public function getRightChild($index)
    {
        $child_index = $index * 2 + 2;
        return ($this->getTailIndex() >= $child_index ? $this->stock[$child_index] : null);
    }

    public function __toString()
    {
        $output = "";
        $exp = 0;
        $index = 0;
        while (true) {
            $row_count = pow(2, $exp);
            for ($i = 0; $i < $row_count; $i++) {
                if (isset($this->stock[$index])) {
                    $output .= /*"#{$index}: " .*/
                        $this->stock[$index] . ", ";
                } else {
                    break 2;
                }
                $index++;
            }
            $exp++;
            $output .= PHP_EOL;
        }
        return $output;
    }
}
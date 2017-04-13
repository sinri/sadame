<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/13
 * Time: 13:55
 */

namespace sinri\sadame\interfaces;


interface Heap
{
    /**
     * build    创建一个空堆    O(n)
     */
    public function reset();

    /**
     * insert    向堆中插入一个新元素    {\displaystyle O(\log n)} O(\log n)
     */
    public function insert($object);

    /**
     * update    将新元素提升使其匹配堆的性质
     */
    public function update();

    /**
     * get    获取当前堆顶元素的值    O(1)
     */
    public function getTop();

    /**
     * delete    删除堆顶元素    {\displaystyle O(\log n)} O(\log n)
     */
    public function deleteTop();

    /**
     * reorganizeAsHeap    使删除堆顶元素的堆再次成为堆
     */
    public function reorganizeAsHeap();

}
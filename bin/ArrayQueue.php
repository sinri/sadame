<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 22:38
 */

namespace sinri\sadame\bin;


use sinri\sadame\interfaces\Queue;

class ArrayQueue implements Queue
{
    private $queue = [];

    public function __construct()
    {
        $this->queue = [];
    }

    public function inQueue($v)
    {
        $this->queue[] = $v;
    }

    public function outQueue()
    {
        $result = array_shift($this->queue);
        return $result;
    }

    public function size()
    {
        return count($this->queue);
    }

    public function isEmpty()
    {
        return empty($this->queue);
    }
}
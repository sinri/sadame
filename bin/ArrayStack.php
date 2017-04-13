<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 21:58
 */

namespace sinri\sadame\bin;


use sinri\sadame\interfaces\Stack;

class ArrayStack implements Stack
{
    private $stack = [];

    public function __construct()
    {
        $this->stack = [];
    }

    public function push($v)
    {
        $this->stack[] = $v;
    }

    public function pop()
    {
        return array_pop($this->stack);
    }

    public function isEmpty()
    {
        return empty($this->stack);
    }

    public function size()
    {
        return count($this->stack);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/13
 * Time: 09:24
 */

namespace sinri\sadame\interfaces;

interface Stack
{
    public function push($v);

    public function pop();

    public function isEmpty();

    public function size();
}
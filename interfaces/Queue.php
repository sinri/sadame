<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/13
 * Time: 09:26
 */

namespace sinri\sadame\interfaces;

interface Queue
{
    public function inQueue($v);

    public function outQueue();

    public function size();

    public function isEmpty();
}
<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/13
 * Time: 09:40
 */

namespace sinri\sadame\interfaces;

interface Node
{
    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param mixed $name
     */
    public function setName($name);

    /**
     * @return int
     */
    public function getValue();

    /**
     * @param int $value
     */
    public function setValue($value);
}
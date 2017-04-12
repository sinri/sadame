<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 14:40
 */

namespace sinri\sadame\bin;


class Node
{
    private $name;
    private $value;

    public function __construct($name, $value = 0)
    {
        $this->name = $name;
        $this->value = $value;
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
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    function __get($name)
    {
        switch ($name) {
            case 'name':
                return $this->name;
            case 'value':
                return $this->value;
            default:
                return null;
        }
    }
}
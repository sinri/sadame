<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 14:43
 */

namespace sinri\sadame\bin;


use sinri\sadame\interfaces\Path;

class StandardPath implements Path
{
    private $from;
    private $to;
    private $value;

    public function __construct($from, $to, $value = 0)
    {
        $this->from = $from;
        $this->to = $to;
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
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
            case 'from':
                return $this->from;
            case 'to':
                return $this->to;
            case 'value':
                return $this->value;
            default:
                return null;
        }
    }

    public function __toString()
    {
        return "From [{$this->from}] To [{$this->to}] Value: " . json_encode($this->value);
    }
}
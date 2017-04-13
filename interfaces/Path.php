<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/13
 * Time: 09:39
 */

namespace sinri\sadame\interfaces;

interface Path
{
    /**
     * @return mixed
     */
    public function getFrom();

    /**
     * @param mixed $from
     */
    public function setFrom($from);

    /**
     * @return mixed
     */
    public function getTo();

    /**
     * @param mixed $to
     */
    public function setTo($to);

    /**
     * @return int
     */
    public function getValue();

    /**
     * @param int $value
     */
    public function setValue($value);
}
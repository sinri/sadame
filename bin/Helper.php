<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 13:59
 */

namespace sinri\sadame\bin;


class Helper
{
    public static function setMatrixCell(&$matrix, $x, $y, $value)
    {
        if (!isset($matrix)) {
            $matrix = [];
        }
        if (!isset($matrix[$x])) {
            $matrix[$x] = [];
        }
        $matrix[$x][$y] = $value;
    }

    public static function getMatrixCell($matrix, $x, $y)
    {
        if (isset($matrix) && isset($matrix[$x]) && isset($matrix[$x][$y])) {
            return $matrix[$x][$y];
        }
        return null;
    }

}
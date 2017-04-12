<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 14:57
 */

namespace sinri\sadame\test;


use sinri\sadame\bin\Traveller;

class TestTraveller extends Traveller
{

    protected function onMoved($is_arrived = false)
    {
        echo "Moved to " . $this->currentNode;
        echo " " . ($is_arrived ? 'OVER' : '') . PHP_EOL;
    }

    protected function determinePath($path)
    {
        if (!empty($path->value['Rule'])) {
            switch ($path->value['Rule']) {
                case "Rule-I":
                    if ($this->note['value'] > 10) {
                        return true;
                    }
                    break;
                case "Rule-II":
                    if ($this->note['value'] > 0) {
                        return true;
                    }
                    break;
            }
            // not fit rule, not this path
            return false;
        }
        // no rule to limit going on this path
        return true;
    }
}
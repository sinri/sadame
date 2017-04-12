<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 13:31
 */

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/TestTraveller.php';

use \sinri\sadame\bin\Graph;

$graph = new Graph();

$graph->addNode("A");
$graph->addNode("B");
$graph->addNode("C");
$graph->addNode("D");

$graph->addPath("A", "B", ["Rule" => 'Rule-I'], Graph::PATH_DIRECTED);
$graph->addPath("A", "C", ["Rule" => 'Rule-II'], Graph::PATH_DIRECTED);
$graph->addPath("B", "D", ["Rule" => false], Graph::PATH_DIRECTED);
$graph->addPath("C", "D", ["Rule" => false], Graph::PATH_DIRECTED);

$tt = new \sinri\sadame\test\TestTraveller();
$tt->ready($graph, "A", "D", ["value" => 1]);
$tt->next();
$tt->next();
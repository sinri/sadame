<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/13
 * Time: 09:56
 */
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/TestTraveller.php';

use \sinri\sadame\bin\MatrixGraph;

echo __FILE__ . PHP_EOL;

$graph = new MatrixGraph();

$graph->addNode("A");
$graph->addNode("B");
$graph->addNode("C");
$graph->addNode("D");

$graph->addPath("A", "B", ["Rule" => 'Rule-I'], MatrixGraph::PATH_DIRECTED);
$graph->addPath("A", "C", ["Rule" => 'Rule-II'], MatrixGraph::PATH_DIRECTED);
$graph->addPath("B", "D", ["Rule" => false], MatrixGraph::PATH_DIRECTED);
$graph->addPath("C", "D", ["Rule" => false], MatrixGraph::PATH_DIRECTED);

$tt = new \sinri\sadame\test\TestTraveller();
$tt->ready($graph, "A", "D", ["value" => 1]);
$tt->next();
$tt->next();
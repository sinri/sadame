<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 21:05
 */

require_once __DIR__ . '/../autoload.php';

use \sinri\sadame\bin\Graph;

$graph = new Graph();

$graph->addNode("A");
$graph->addNode("B");
$graph->addNode("C");
$graph->addNode("D");
$graph->addNode("E");
$graph->addNode("F");

$graph->addPath("A", "B", 7, Graph::PATH_UNDIRECTED);
$graph->addPath("A", "C", 15, Graph::PATH_UNDIRECTED);
$graph->addPath("A", "D", 8, Graph::PATH_UNDIRECTED);
$graph->addPath("C", "D", 3, Graph::PATH_UNDIRECTED);
$graph->addPath("C", "F", 4, Graph::PATH_UNDIRECTED);
$graph->addPath("D", "E", 2, Graph::PATH_UNDIRECTED);
$graph->addPath("D", "B", 6, Graph::PATH_UNDIRECTED);
$graph->addPath("B", "E", 1, Graph::PATH_UNDIRECTED);
$graph->addPath("E", "F", 10, Graph::PATH_UNDIRECTED);

$dijkstra = new \sinri\sadame\bin\Dijkstra();
$dijkstra->graph = $graph;
$result = $dijkstra->go("A", "F");
print_r($result);


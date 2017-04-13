<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/13
 * Time: 10:34
 */

require_once __DIR__ . '/../autoload.php';

$graph = new \sinri\sadame\bin\MatrixGraph();

for ($i = 0; $i < 4; $i++) {
    for ($j = 0; $j < 4; $j++) {
        $node_name = "({$i},{$j})";
        $graph->addNode($node_name, ["x" => $i, "y" => $j]);
    }
}

for ($i = 0; $i < 4; $i++) {
    for ($j = 0; $j < 3; $j++) {
        $node_name_1 = "(" . ($j) . "," . $i . ")";
        $node_name_2 = "(" . ($j + 1) . "," . $i . ")";
        $graph->addPath($node_name_1, $node_name_2, rand(1, 10), \sinri\sadame\interfaces\Graph::PATH_UNDIRECTED);
    }
}
for ($i = 0; $i < 4; $i++) {
    for ($j = 0; $j < 3; $j++) {
        $node_name_1 = "(" . $i . "," . ($j) . ")";
        $node_name_2 = "(" . $i . "," . ($j + 1) . ")";
        $graph->addPath($node_name_1, $node_name_2, rand(1, 10), \sinri\sadame\interfaces\Graph::PATH_UNDIRECTED);
    }
}

echo "NODES:" . PHP_EOL;
foreach ($graph->getNodes() as $node) {
    echo $node . PHP_EOL;
}
echo "PATHS:" . PHP_EOL;
foreach ($graph->getPaths() as $path) {
    echo $path . PHP_EOL;
}

echo "READY!" . PHP_EOL;

$astar = new \sinri\sadame\algorithm\AStar();
$astar->graph = $graph;
$result = $astar->search("(0,0)", "(3,3)");
echo "RESULT:" . PHP_EOL;
//var_dump($result);
echo implode(" - ", $result);
echo PHP_EOL;
echo "OVER" . PHP_EOL;
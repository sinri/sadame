<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 15:36
 */

require_once __DIR__ . '/helper/Helper.php';

require_once __DIR__ . '/interfaces/Stack.php';
require_once __DIR__ . '/interfaces/Queue.php';
require_once __DIR__ . '/interfaces/Graph.php';
require_once __DIR__ . '/interfaces/Node.php';
require_once __DIR__ . '/interfaces/Path.php';

require_once __DIR__ . '/bin/ArrayStack.php';
require_once __DIR__ . '/bin/ArrayQueue.php';
require_once __DIR__ . '/bin/StandardNode.php';
require_once __DIR__ . '/bin/StandardPath.php';
require_once __DIR__ . '/bin/MatrixGraph.php';

require_once __DIR__ . '/algorithm/Traveller.php';
require_once __DIR__ . '/algorithm/Dijkstra.php';
require_once __DIR__ . '/algorithm/AStar.php';

<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/13
 * Time: 14:53
 */

require_once __DIR__ . '/../autoload.php';

$heap = new \sinri\sadame\bin\BinaryMinHeap();

$heap->insert(2);
$heap->insert(3);
$heap->insert(1);
$heap->insert(4);
$heap->insert(6);
$heap->insert(7);
$heap->insert(9);
$heap->insert(5);
$heap->insert(8);

echo "INIT:" . PHP_EOL;
echo $heap . PHP_EOL;

echo "TOOK " . $heap->getTop() . PHP_EOL;
$heap->deleteTop();

echo "NOW:" . PHP_EOL;
echo $heap . PHP_EOL;

echo "TOOK " . $heap->getTop() . PHP_EOL;
$heap->deleteTop();

echo "NOW:" . PHP_EOL;
echo $heap . PHP_EOL;
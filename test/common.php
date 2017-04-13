<?php
/**
 * Created by PhpStorm.
 * User: Sinri
 * Date: 2017/4/12
 * Time: 22:09
 */

require_once __DIR__ . '/../autoload.php';

echo __FILE__ . PHP_EOL;

echo "STACK" . PHP_EOL;
$stack = new \sinri\sadame\bin\ArrayStack();
$stack->push(1);
$stack->push(2);
echo $stack->pop();
echo $stack->isEmpty() ? 'E' : 'F';
echo $stack->size();
$stack->push(3);
echo $stack->pop();
echo $stack->pop();
echo PHP_EOL;

echo "QUEUE" . PHP_EOL;
$queue = new \sinri\sadame\bin\ArrayQueue();
$queue->inQueue(1);
$queue->inQueue(2);
$queue->inQueue(3);
echo $queue->outQueue();
echo $queue->size();
echo $queue->isEmpty() ? 'E' : 'F';
echo $queue->outQueue();
echo $queue->outQueue();
echo PHP_EOL;

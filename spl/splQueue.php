<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 7:38 PM
 */
$queue = new SplQueue();
$queue->setIteratorMode(SplQueue::IT_MODE_DELETE);

$queue->enqueue('one');
$queue->enqueue('two');
$queue->enqueue('three');

$queue->dequeue();
$queue->dequeue();

echo $queue->top(); //three
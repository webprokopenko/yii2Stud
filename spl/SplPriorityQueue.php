<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 7:48 PM
 */

$queue = new SplPriorityQueue();
$queue->setExtractFlags(SplPriorityQueue::EXTR_DATA);

$queue->insert('Q', 1);
$queue->insert('W', 2);
$queue->insert('E', 6);
$queue->insert('R', 3);
$queue->insert('T', 4);

$queue->top();

while ($queue->valid()){
    echo $queue->current(); //ETRWQ
    $queue->next();
}
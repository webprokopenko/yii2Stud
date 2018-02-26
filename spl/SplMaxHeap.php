<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 7:42 PM
 */
$heap = new SplMaxHeap();
$heap->insert('111');
$heap->insert('999');
$heap->insert('777');


echo $heap->extract(); // 999
echo $heap->extract(); //777
echo $heap->extract(); //111



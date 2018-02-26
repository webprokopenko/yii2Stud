<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 7:46 PM
 */

$heap = new SplMinHeap();
$heap->insert('111');
$heap->insert('333');
$heap->insert('777');

echo $heap->extract(); //111
echo $heap->extract(); //333
echo $heap->extract(); //777

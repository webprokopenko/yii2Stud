<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 7:58 PM
 * SplFixedArray - ключи только циры больше 0.
 */

$a = new SplFixedArray(1000);
$count = 1000;
for($i=0;$i<$count;$i++){
    $a[$i] = $i;
}


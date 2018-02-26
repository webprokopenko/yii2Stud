<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 8:03 PM
 * http://php.net/manual/ru/book.spl.php
 */

$s = new SplObjectStorage(); // создаем хранилище
$o1 = new StrClass;
$o2 = new StrClass;
$o3 = new StrClass;

$s->attach($o1); //прикрепляем к хранилищу объект
$s->attach($o2); //прикрепляем к хранилищу объект

var_dump($s->contains($o1)); // true
var_dump($s->contains($o2)); // true
var_dump($s->contains($o3)); // false

$s->detach($o1);

var_dump($s->contains($o1)); // false
var_dump($s->contains($o2)); // true
var_dump($s->contains($o3)); // false
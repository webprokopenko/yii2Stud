<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/12/18
 * Time: 8:19 PM
 */
$component = new Journal();
$component->attach(new User1());
$component->attach(new User2());
$component->published();


$vasiliy = new Users($array_bd);
$vitaly = new Users('vitaly@gmail.com', 'Subject for vitaly', 'Body for Vitaly');

$journal2 = new Journal();
$journal2->attach($vasiliy);
$journal2->attach($vitaly);
$journal2->published();
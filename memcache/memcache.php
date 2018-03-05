<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 3/5/18
 * Time: 8:30 PM
 */

$memcache_obj = new Memcache();

$memcache_obj->connect('127.0.0.1',11211) or die('Could not connect to memcache');

//Пытаемся получить объект с ключем var
$var_key = $memcache_obj->get('var');

if(!empty($var_key)){
    //Если объект закеширован выводим его
    var_dump($var_key);
}
else{
    //Если в кэше нет объекта с ключом var создаем его он  будет храниться 15 секунд
    $memcache_obj->set('var',['1',213],false,15);

    // Выводим закэшированные данные на экран
    var_dump($memcache_obj->get('var'));
}

$memcache_obj->close();
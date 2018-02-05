<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 05.02.2018
 * Time: 19:57
 */
//Включаем сам фреймверк
require(__DIR__.'/../vendor/yiisoft/yii2/Yii.php');
//Подключаем файл конфирурации
$config = require(__DIR__.'/../config/web.php');
//Создаем и немедленно запускаем приложение
(new yii\web\Application($config))->run();
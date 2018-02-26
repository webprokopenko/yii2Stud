<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 7:11 PM
 * spl_autoload_call - принудительно загружает класс по его имени используя
 * все доступные в системе автозагрузчики
 * spl_autoload_extensions - возвращает/модифицирует расширения файлов из которых происходит загрузка
 * неинициализированных классов
 * spl_autoload_functions - возвращает список всех зарегистрированных автозагрузчиков в системе
 * spl_autoload_register - регистрация собственного автозагрузчика в стеке автозагрузки
 * spl_autoload_unregister - удаление автозагрузчика из стека автозагрузки
 * spl_autoload - основная функция автоматической загрузки классов. Именно она вызывается при обращении
 * к классу который еще не инициализован. Данная функция активирует все автоматические загрузчики из сетк
 * а в порядке их добавления
 */
class MyClass1{
    public function __construct()
    {
        echo "My class1 construct";
    }
}
class MyClass2{
    public function __construct()
    {
        echo "My class2 construct";
    }
}
//функция автозагрузки загружающая классы из папки classes
function loadFromClasses($aClassName){
    $aclassFilePath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR. $aClassName.'.php';
    if(file_exists($aclassFilePath)){
        echo "executing __autoload()";
        require_once $aclassFilePath;
        return true;
    }
    return false;
}
//функция автозагрузки загружающая классы из папки lib
function loadFromLibs($aClassName){
    $aclassFilePath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR. $aClassName.'.php';
    if(file_exists($aclassFilePath)){
        echo "executing __autoload()";
        require_once $aclassFilePath;
        return true;
    }
    return false;
}


spl_autoload_register('loadFromLibs');
spl_autoload_register('loadFromClasses');


spl_autoload_unregister('loadFromClasses');

spl_autoload_register('__autoload');

//Что находится в стеке автозагрузки

var_dump(spl_autoload_functions());



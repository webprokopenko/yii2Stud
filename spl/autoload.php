<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 7:02 PM
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
function __autoload($aClassName){
    $aclassFilePath = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR. $aClassName.'.php';
    if(file_exists($aclassFilePath)){
        echo "executing __autoload()";
        require_once $aclassFilePath;
        return true;
    }
    return false;
}
$obj1 = MyClass1();
$obj2 = MyClass2();


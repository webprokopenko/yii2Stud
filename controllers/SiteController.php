<?php
namespace app\controllers;
class SiteController extends \yii\web\Controller{
    public function actionIndex()
    {
        $arr = ['1'=>2,2=>'123',3=>13,3];
        $t = compact('arr');
        var_dump($arr);
        echo "<br>";
        var_dump($t);
        //return 'Our CRM';
    }
}
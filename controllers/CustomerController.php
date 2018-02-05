<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 05.02.2018
 * Time: 20:34
 */
use \yii\web\Controller;

Class CustomerController extends Controller{
    public function actionIndex(){
        $records = $this->findRecordsByQuery();
        return $this->render('index',compact('records'));
    }
}
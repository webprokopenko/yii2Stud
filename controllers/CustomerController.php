<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 05.02.2018
 * Time: 20:34
 */
use \yii\web\Controller;
use \app\models\customer\CustomerRecord;
use \app\models\customer\PhoneRecord;
use yii\helpers\Html;
use yii\sphinx\Query;

Class CustomerController extends Controller{
    /**
     *
     */
    public function actionIndex(){
//        $records = $this->findRecordsByQuery();
//        return $this->render('index',compact('records'));
    }
    public function actionSearch(){
        $word = Html::encode(Yii::$app->request->get('word'));
        $query = new Query();
        $rows = $query->from('blog')
                    ->match($word)
                    ->all();

        return $this->render('search', ['rows'=>$rows]);

    }
    //Метод для сохранения модели клиента в БД
    private function store(Customer $customer){
        $customer_record = new CustomerRecord();
        $customer_record->name = $customer->name;
        $customer_record->birth_date = $customer->birth_date;
        $customer_record->notes = $customer->notes;
        $customer_record->save();

        foreach ($customer->phones as $phone) {
            $phone_record = new PhoneRecord();
            $phone_record->number = $phone->number;
            $phone_record->customer_id = $customer_record->id;
            $phone_record->save();
        }
    }
    //Метод для конвертирования активных записей в экземпляр класса
    private function makeCustomer(CustomerRecord $customer_record, PhoneRecord $phone_record){
        $name = $customer_record->name;
        $birth_date = new DateTime($customer_record->birth_date);
        $customer = new Customer($name, $birth_date);
        $customer->notes = $customer_record->notes;
        $customer->phones[] = new Phone($phone_record);
        return $customer;
    }
}
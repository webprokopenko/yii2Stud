<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 3/12/18
 * Time: 8:29 PM
 */
class LiqPayController extends \yii\web\Controller{
    private $public_key;
    private $private_key;

    public function actionIndex()
    {
        $liqpay = new LiqPay($this->public_key, $this->private_key);
        $res = $liqpay->api("request", array(
            'action'         => 'pay',
            'version'        => '3',
            'phone'          => '380950000001',
            'amount'         => '1',
            'currency'       => 'USD',
            'description'    => 'description text',
            'order_id'       => 'order_id_1',
            'card'           => '4731195301524634',
            'card_exp_month' => '03',
            'card_exp_year'  => '22',
            'card_cvv'       => '111',
            'sandbox'        =>  '1',
        ));

        $res =
            '{
  "action": "pay",
  "payment_id": 165172,
  "status": "success",
  "version": 3,
  "type": "buy",
  "paytype": "card",
  "public_key": "i000000000",
  "acq_id": 414963,
  "order_id": "98R1U1OV1485849059893399",
  "liqpay_order_id": "NYMK3AE61501685438251925",
  "description": "description",
  "sender_phone": "380950000001",
  "sender_first_name": "first_name",
  "sender_last_name": "last_name",
  "sender_card_mask2": "473118*50",
  "sender_card_bank": "pb",
  "sender_card_type": "visa",
  "sender_card_country": 804,
  "dcc_allowed": [{
    "amount": 3.5984,
    "rate": 27.7905,
    "commission": 0.0,
    "currency": "USD"
  }],
  "ip": "8.8.8.8",
  "card_token": "CDRES215658546306B200061FCC53A86B",
  "amount": 100.0,
  "currency": "UAH",
  "sender_commission": 0.0,
  "receiver_commission": 0.0,
  "agent_commission": 0.0,
  "amount_debit": 100.0,
  "amount_credit": 100.0,
  "commission_debit": 0.0,
  "commission_credit": 0.0,
  "currency_debit": "UAH",
  "currency_credit": "UAH",
  "sender_bonus": 0.0,
  "amount_bonus": 0.0,
  "bonus_type": "bonusplus",
  "bonus_procent": 0.0,
  "authcode_debit": "388000",
  "authcode_credit": "329007",
  "rrn_debit": "000663747000",
  "rrn_credit": "000663747003",
  "mpi_eci": "7",
  "is_3ds": false,
  "create_date": 1501685446633,
  "end_date": 1501685446633,
  "transaction_id": 165172
}'
    }
    if($res['status'] == 'success'){
    //Все хорошо оплата прошла отправляем email клиенту и перенаправляем на страницу поздравления

}
    if($res['status'] == '3ds_verify'){
     new LiqPay($this->public_key, $this->private_key);
}
}
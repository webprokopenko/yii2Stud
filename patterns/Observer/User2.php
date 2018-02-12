<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/12/18
 * Time: 8:33 PM
 */

class User2 implements Observer{
    private $_email = 'user@gmail.com';
    private $_subject = 'New email from Observable';
    private $_body = 'Text email';

    public function userMail()
    {
        mail($this->_email,$this->_subject,$this->_body);
    }

    public function update()
    {
        $this->userMail();
    }
}
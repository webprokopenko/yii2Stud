<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/12/18
 * Time: 8:24 PM
 */
interface Observable{
    //add new listener
    public function attach(Observer $observer);

    //send all listener
    public function notify();

}
<?php
require_once 'Beverage.php';
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/12/18
 * Time: 7:48 PM
 */
class Espresso extends Beverage{
    public function __construct()
    {
        $this->description = 'Espresso';
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function cost()
    {
        return 1.99;
    }
}
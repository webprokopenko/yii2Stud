<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/12/18
 * Time: 7:41 PM
 */
abstract class Beverage{
    public $description = 'Unknow Beverate';

    abstract public function getDescription();

    protected abstract function cost();
}
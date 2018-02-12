<?php
require_once 'Beverage.php';
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/12/18
 * Time: 7:52 PM
 */
abstract class CondimentDecorator extends Beverage{

    public function getDescription()
    {
        return $this->description;
    }
    abstract function __construct(Beverage $beverage);
}
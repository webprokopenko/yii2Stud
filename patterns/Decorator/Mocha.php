<?php
require_once 'CondimentDecorator.php';
require_once 'Beverage.php';
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/12/18
 * Time: 7:54 PM
 */
class Mocha extends CondimentDecorator{
    public $beverage;
    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    public function cost()
    {
        return 0.20 + $this->beverage->cost();
    }

    public function getDescription()
    {
        return $this->beverage->getDescription(). ", Mocha";
    }
}
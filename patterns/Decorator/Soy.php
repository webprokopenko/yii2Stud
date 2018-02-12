<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/12/18
 * Time: 8:04 PM
 */
class Soy extends CondimentDecorator{
    public $beverage;

    public function __construct(Beverage $beverage)
    {
        $this->beverage = $beverage;
    }

    public function getDescription()
    {
        return $this->beverage->getDescription()." , Soy";
    }

    public function cost()
    {
        return 0.31 + $this->beverage->cost();
    }
}
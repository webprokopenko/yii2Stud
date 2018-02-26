<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 8:19 PM
 */

interface ComparatorInterface
{
    public function compare($a, $b):int;
}
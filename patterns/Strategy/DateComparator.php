<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 8:21 PM
 */
class DateComparator implements ComparatorInterface
{
    public function compare($a, $b): int
    {
        $aDate = new DateTime($a['date']);
        $bDate = new DateTime($b['date']);

        //Число типа integer меньше,больше или равное нулю,
        //когда a соответственно меньше больше или равно b доступно с 7 версии php
        return $aDate <=> $bDate;

    }
}
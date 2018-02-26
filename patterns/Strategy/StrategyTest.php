<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 8:31 PM
 */
class StrategyTest extends \PHPUnit\Framework\TestCase
{
    public function provideIntegers()
    {
        return [
            [
                [['id'=>2], ['id'=>1]]
            ],
            [
                [['id'=>3], ['id'=>1]]
            ]
        ];
    }

    public function provideDates()
    {
        return [
            [
                [['date'=>'2018-03-01'], ['date'=>'2018-01-04']]
            ],
            [
                [['date'=>'2017-03-01'], ['date'=>'2016-01-04']]
            ]
        ];
    }

    public function testIdComparator($collection, $expected)
    {
        $obj = new Context(new idComparator());
        $elements = $obj->executeStrategy($collection);

        $firstElement = array_shift($elements);
        $this->assertEquals($expected, $firstElement);
    }

    public function testDateComparator($collection, $expected)
    {
        $obj = new Context(new DateComparator());
        $elements = $obj->executeStrategy($collection);
        
        $firstElement = array_shift($elements);
        $this->assertEquals($expected, $firstElement);
    }
}
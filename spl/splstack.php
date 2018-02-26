<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/26/18
 * Time: 7:29 PM
 */
$stack = new SplStack();
//добавляем элемент в стек
$stack->push('1');
$stack->push('2');
$stack->push('3');

echo $stack->count(); //3
echo $stack->top(); //3
echo $stack->bottom(); //1
echo $stack->serialize(); // i:6;;s13:

//извлечение элементов из стека
echo $stack->pop(); //3
echo $stack->pop(); //2
echo $stack->pop(); //1

class SplStackSelf extends SplStack{
    public function sortEth()
    {

    }
}

$selfStack = new SplStackSelf();
$selfStack->push(1);
$selfStack->sortEth();


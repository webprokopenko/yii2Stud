<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/12/18
 * Time: 7:43 PM
 */
$espresso = new Espresso();
$espresso = new Mocha($espresso);
$espresso = new Soy($espresso);

echo $espresso->getDescription();
echo "<br>";
echo $espresso->cost();

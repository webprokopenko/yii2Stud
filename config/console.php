<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 4/4/16
 * Time: 8:24 PM
 */
return [
    'id'            =>  'crmapp-console',
    'basePath'      =>  dirname(__DIR__),
    'components'    =>  [
        'db'    =>  require (__DIR__.'/db.php'),
    ],
];
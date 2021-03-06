<?php
return [
    'id'            =>  'crmapp',
    'basePath'      =>  realpath(__DIR__.'/../'),
    'components'    =>  [
        'db'    =>  require (__DIR__.'/db.php'),
        'request'   =>  [
            'cookieValidationKey'   =>  'secret key',
        ],
        'urlManager'    =>[
            'enablePrettyUrl'   => true,
            'showScriptName'    => false,
        ],
        'sphinx'=>[
            'class' => 'yii\sphinx\Connection',
            'dsn' => 'mysql:host=127.0.0.1;port=9306;',
            'username'=>'',
            'password'=>'',
        ]
    ],
];